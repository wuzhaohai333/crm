<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PowerController extends CommonController
{
    /** 权限管理*/
    public function power(){
        return view('power');
    }

}
