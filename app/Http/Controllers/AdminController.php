<?php

namespace App\Http\Controllers;
use App\Models\Users;
use App\Models\Admin;
use App\Models\Projects;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
    	$projects = Projects::orderByDesc("ADDED_ON")->get()->take(2);
    	return view("admin.index",[
    		"projects"=>$projects,
    		"user"=>$request->user()
    	]);
    }
    
    public function projects(Request $request)
    {
      $projects = Projects::orderByDesc("ADDED_ON")->get();
    	return view("admin.projects",[
    		"projects"=>$projects,
    		"user"=>$request->user()
    	]);
    }
    public function items(Request $request)
    {
      $items = Items::orderByDesc("ADDED_ON")->get();
      return view("admin.items",[
        "items"=>$items,
        "user"=>$request->user()
      ]);
    }
    
    public function login(Request $request)
    {
    	return view("admin.login");
    }
    
    public function logout(Request $request)
    {
    	Auth::guard('admin')->logout($request);
    	$request->session()->invalidate();
    	$request->session()->regenerateToken();
    	return redirect()->intended('');
    }
    
    public function authenticate(Request $request)
    {
    	$user = Admin::where('username',$request->email)->first();
    	if($user == null) $user = Admin::where('email',$request->email)->first();
    	
    	if($user == null) return "No user with that name";
    	
    	if(Hash::check($request->password,$user->password)) $auth = true;
    	else $auth = false;
    	
    	if($auth)
    	{
    		if($request->remember_me == "on") $remember = true;
    		else $remember = false;
    		Auth::guard('admin')->login($user,$remember);
    		return redirect()->intended('/admin');
    	}
    	else{
    		return "Invalid password ";
    	}
    	return "Invalid user  ".$request->email;
    }
}
