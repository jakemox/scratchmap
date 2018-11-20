<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function show() 
    {
        return view('search');
    }

    public function suggest(Request $request) {
        $string = $request->input('s');

        $cities = DB::table('cities')
            ->where('name', 'LIKE', "{$string}%")
            ->limit(100)
            ->orderBy('name')
            ->get();

        return $cities;
    }
}
