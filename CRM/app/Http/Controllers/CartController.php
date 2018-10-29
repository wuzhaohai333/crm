<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Flight;
use App\Model\Admin;
use DB;


class CartController extends Controller
{
    public function catr( Request  $request){
       // $user = $request->session()->get('user');
       // print_r($user);
        return view('index');
    }
}
