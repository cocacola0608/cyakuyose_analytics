<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyPlusStatisticsController extends Controller
{
    public function index()
    {
        $data = DB::table('daily_statistics')
            ->select('date', 'contract_count')
            ->where('type', '=', 'plus')
            ->orderBy('date', 'asc')
            ->limit(30)
            ->get();

        // データを指定された形式に変換
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'month' => $item->date,
                'number' => $item->contract_count
            ];
        }

        return response()->json($formattedData);
    }
}