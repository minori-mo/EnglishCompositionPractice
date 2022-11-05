<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mainController extends Controller
{
    public function index()
    {
        //TODO 文章のレベルをDBから取得
        $levels = DB::select('SELECT DISTINCT level FROM sentence ORDER BY level asc');
        $sentences = [];
        return view('main',['levels' => $levels,'sentences' => $sentences]);
    }

    public function post(Request $request)
    {
        //レベルと問題数を受け取って問題を取得
        $param = [
            'level' =>  $request->level,
            'quantity' =>  $request->quantity
        ];
        $levels = [];
        //TODO　ランダムで取得するように修正
        $sentences = DB::select('SELECT * FROM sentence WHERE level = :level LIMIT :quantity',$param);
        return view('main',['levels' => $levels,'sentences' => $sentences]);
    }
}
