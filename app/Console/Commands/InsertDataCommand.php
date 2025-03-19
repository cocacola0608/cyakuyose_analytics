<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertDataCommand extends Command
{
    protected $signature = 'data:insert';
    protected $description = 'Count data from plus_db and insert to analytics db';

    public function handle()
    {
        try {
            Log::channel('batch')->info('Batch started');

            // plus_dbから月次データを集計
            $aggregatedData = DB::connection('plus_db')
                ->table('contract')
                ->select(
                    DB::raw('COUNT(*) as contract_count')
                    // 必要に応じて他の集計項目を追加
                )
                ->whereNull('demo')
                ->where('contract', 1)
                ->get();

            if ($aggregatedData->isEmpty()) {
                Log::channel('batch')->info('No data to aggregate');
                return;
            }

            // monthly_statisticsテーブルへの挿入処理
            DB::beginTransaction();

            foreach ($aggregatedData as $data) {
                DB::connection('mysql')->table('monthly_statistics')->insert([
                    //現在日時の先月の月をセット
                    'yearmonth' => now()->format('Ym'),
                    'contract_count' => $data->contract_count,
                    'type' => 'plus',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            Log::channel('batch')->info('Monthly statistics insertion completed', [
                'count' => $aggregatedData->count()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('batch')->error('Error in data insertion: ' . $e->getMessage());
            $this->error('Error in data insertion: ' . $e->getMessage());
            throw $e;
        }
    }
} 