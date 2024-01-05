<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class DetailController extends Controller
{
    

    public function index(){
        return view("pages.detail");
    }
}
