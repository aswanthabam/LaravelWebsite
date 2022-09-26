<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsControllerPublic;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("",[HomeController::class,"home"])->name("home");
Route::get("/projects",[ProjectsControllerPublic::class,"allProjects"])->name("all-projects");
Route::get("/projects/{project_name}",[ProjectsControllerPublic::class,"viewProject"])->name("view-project");
Route::get("/projects/{project_id}/{item_id}",[ProjectsControllerPublic::class,"viewItem"])->name("view-item");
Route::get("/item/{item_id}",[ProjectsControllerPublic::class,"viewItem"])->name("view-item");

include __DIR__."/admin.php";