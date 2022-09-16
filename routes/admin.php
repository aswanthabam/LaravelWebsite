<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectsController;
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

Route::get("/admin",[AdminController::class,"index"])->middleware("auth:admin")->name("admin-index"); // Admin home page 

Route::get("/admin/add/project",[ProjectsController::class,"newProject"])->middleware("auth:admin")->name("create-project"); // Add new project

Route::post("/admin/add/project",[ProjectsController::class,"createProject"])->middleware("auth:admin")->name("create-project-post"); // Commit the submission of new project

Route::get("/admin/add/project/{project}/item",[ProjectsController::class,"newItem"])->middleware("auth:admin")->name("create-item"); // Add an item to project/A version

Route::post("/admin/add/project/{project}/item",[ProjectsController::class,"createItem"])->middleware("auth:admin")->name("create-item-post"); // Commit the new item/Version of project

Route::get("/admin/view/project/{project}",[ProjectsController::class,"viewProject"])->middleware("auth:admin")->name("view-project"); // View Project

Route::get("/admin/view/project/{project}/item/{item}",[ProjectsController::class,"viewItem"])->middleware("auth:admin")->name("view-item"); // View Project item.or version

Route::get("/login",[AdminController::class,"login"])->name("login"); // Login

Route::post("/authenticate",[AdminController::class,"authenticate"])->name("authenticate"); // Authenticate a user