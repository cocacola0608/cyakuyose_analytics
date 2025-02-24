<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        try {
            // デバッグコードをコメントアウト
            /*
            dd([
                'Laravel Version' => app()->version(),
                'PHP Version' => PHP_VERSION
            ]);
            */
            
            return view('welcome')->with([
                'title' => 'Welcome'  // レイアウトのタイトルなどに使用可能
            ]);
        } catch (\Exception $e) {
            dd("エラー: " . $e->getMessage());
        }
    }
}