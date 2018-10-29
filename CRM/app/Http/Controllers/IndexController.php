<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $data = DB::table('crm_power')->get();
        $data = json_decode($data,true);
        return view('index',['data'=>$data]);
    }
}
