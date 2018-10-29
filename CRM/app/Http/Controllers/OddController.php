<?php
/**
 * 跟单管理
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OddController extends Controller
{
    /**
     * 跟单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function oddList(){
        return view('odd.oddList');
    }
}
