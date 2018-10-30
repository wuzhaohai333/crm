<?php
/**
 * 跟单管理
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OddController extends CommonController
{
    /** 跟单管理列表*/
    public function oddList(){
        return view('odd.oddList');
    }

}
