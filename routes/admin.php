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

Route::get("/admin/projects",[AdminController::class,"projects"])->middleware("auth:admin")->name("admin-projects"); // Admin Projects all

Route::get("/admin/add/project",[ProjectsController::class,"newProject"])->middleware("auth:admin")->name("create-project"); // Add new project

Route::post("/admin/add/project",[ProjectsController::class,"createProject"])->middleware("auth:admin")->name("create-project-post"); // Commit the submission of new project

Route::get("/admin/add/project/{project}/multi",[ProjectsController::class,"addMulti"])->middleware("auth:admin")->name("add-multi"); // Add an Multi item

Route::post("/admin/add/project/{project}/multi",[ProjectsController::class,"addMultiPost"])->middleware("auth:admin")->name("add-multi-post"); // Add an Multi item

Route::get("/admin/add/project/{project}/item",[ProjectsController::class,"newItem"])->middleware("auth:admin")->name("create-item"); // Add an item to project/A version

Route::get("/admin/add/project/{project}/multi/{item}/item",[ProjectsController::class,"newItem"])->middleware("auth:admin")->name("create-item"); // Add an item to project/A version

Route::post("/admin/add/project/{project}/item",[ProjectsController::class,"createItem"])->middleware("auth:admin")->name("create-item-post"); // Commit the new item/Version of project

Route::post("/admin/add/project/{project}/multi/{item}/item",[ProjectsController::class,"createItem"])->middleware("auth:admin")->name("create-item-post"); // Commit the new item/Version of project

Route::get("/admin/view/project/{project}",[ProjectsController::class,"viewProject"])->middleware("auth:admin")->name("view-project"); // View Project

Route::get("/admin/view/project/{project}/item/{item}",[ProjectsController::class,"viewItem"])->middleware("auth:admin")->name("view-item"); // View Project item.or version

Route::get("/admin/edit/project/{project_id}",[ProjectsController::class,"editProject"])->middleware("auth:admin")->name("edit-project"); // Edit project

Route::post("/admin/edit/project/{project_id}",[ProjectsController::class,"editProjectPost"])->middleware("auth:admin")->name("edit-project-post"); // Edit project

Route::get("/admin/edit/project/{project_id}/item/{item_id}",[ProjectsController::class,"editItem"])->middleware("auth:admin")->name("edit-item"); // Edit project

Route::post("/admin/edit/project/{project_id}/item/{item_id}",[ProjectsController::class,"editItemPost"])->middleware("auth:admin")->name("edit-item-post"); // Edit project

Route::get("/admin/delete/project/{project_id}",[ProjectsController::class,"deleteProject"])->middleware("auth:admin")->name("delete-project"); // Delete project

Route::get("/admin/delete/project/{project_id}/item/{item_id}",[ProjectsController::class,"deleteItem"])->middleware("auth:admin")->name("delete-item"); // Delete Item






Route::get("/login",[AdminController::class,"login"])->name("login"); // Login

Route::post("/authenticate",[AdminController::class,"authenticate"])->name("authenticate"); // Authenticate a user

