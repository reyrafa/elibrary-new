<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisabledAccount extends Controller
{
    public function index(){
        return \view('disabled.index');
    }

}

