<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    public function index()
    {
        try {
            // テーブル一覧を取得
            $tables = DB::connection('plus_db')
                ->select('SHOW TABLES');
            
            //dd($tables); // テーブル一覧を表示
            exit();
            $data = DB::connection('plus_db')
                ->table('contract')
                ->get();
            
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 