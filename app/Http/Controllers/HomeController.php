<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
class HomeController extends Controller
{
    //
    function home(Request $request)
    {
    	$pro = Projects::orderByDesc("ADDED_ON")->get()->take(3);
    	return view("home.home",["projects"=>$pro]);
    }
}
