<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyStatisticsController extends Controller
{
    public function index()
    {
        $data = DB::table('daily_statistics')
            ->select('date', 'contract_count', 'type')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json($data);
    }
}