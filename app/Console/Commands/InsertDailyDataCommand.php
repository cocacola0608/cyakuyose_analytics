<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertDailyDataCommand extends Command
{
    protected $signature = 'data:insert-daily';
    protected $description = 'Count daily data from plus_db and basic_db and insert to analytics db';

    public function handle()
    {
        //キャクヨセplus
        try {
            Log::channel('batch')->info('Batch Daily キャクヨセplus started');

            // plus_dbから日次データを集計
            //SELECT count(*) FROM `memberShip` LEFT JOIN `contract` ON `memberShip`.`contractId` = `contract`.`contractId` WHERE `contract`.`contract` = 1 AND `demo` IS NULL;
            $aggregatedData = DB::connection('plus_db')
                ->table('memberShip')
                ->leftJoin('contract', 'memberShip.contractId', '=', 'contract.contractId')
                ->select(
                    DB::raw('COUNT(*) as contract_count')
                )
                ->whereNull('demo')
                ->where('contract', 1)
                ->get();

            if ($aggregatedData->isEmpty()) {
                Log::channel('batch')->info('No data to aggregate');
                return;
            }

            // daily_statisticsテーブルへの挿入処理
            DB::beginTransaction();

            foreach ($aggregatedData as $data) {
                DB::connection('mysql')->table('daily_statistics')->insert([
                    'date' => now()->subDay()->format('Ymd'),
                    'contract_count' => $data->contract_count,
                    'type' => 'plus',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            Log::channel('batch')->info('Daily statistics insertion completed', [
                'count' => $aggregatedData->count()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('batch')->error('Error in data insertion: ' . $e->getMessage());
            $this->error('Error in data insertion: ' . $e->getMessage());
            throw $e;
        }

        //キャクヨセ
        try {
            Log::channel('batch')->info('Batch Daily キャクヨセ started');

            // basic_dbから日次データを集計
            //SELECT count(*) FROM `memberShip` LEFT JOIN `contract` ON `memberShip`.`contractId` = `contract`.`contractId` WHERE `contract`.`contract` = 1 AND `demo` IS NULL;
            $aggregatedData = DB::connection('basic_db')
                ->table('memberShip')
                ->leftJoin('contract', 'memberShip.contractId', '=', 'contract.contractId')
                ->select(
                    DB::raw('COUNT(*) as contract_count')
                )
                ->whereNull('demo')
                ->where('contract', 1)
                ->get();

            if ($aggregatedData->isEmpty()) {
                Log::channel('batch')->info('No data to aggregate');
                return;
            }

            // daily_statisticsテーブルへの挿入処理
            DB::beginTransaction();

            foreach ($aggregatedData as $data) {
                DB::connection('mysql')->table('daily_statistics')->insert([
                    'date' => now()->subDay()->format('Ymd'),
                    'contract_count' => $data->contract_count,
                    'type' => 'basic',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            Log::channel('batch')->info('Daily statistics insertion completed', [
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