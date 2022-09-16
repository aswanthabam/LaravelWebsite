<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    function home(Request $request)
    {
    	return view("home/home");
    }
}
