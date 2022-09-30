<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use Illuminate\Support\Facades\Hash;
use App\Models\Items;
use App\Models\MultiItems;
use App\Utils\StringUtils;
class ProjectsController extends Controller
{
    /*
    |--------------------------------------------------
    | FUNCTION : addMulti(Request, project_id) : view
    | URL : /admin/add/project/{project_id}/multi 
    | METHOD : GET 
    |--------------------------------------------------
    | FORM FOR ADDING NEW MULTI PROJECT ENVIRONMENT.
    |
    */
    public function addMulti(Request $request,$project_id)
    {
      $project = Projects::where("project_id",$project_id)->first();
      if($project == null) return redirect("admin")->with("status","No project found");
      return view("admin.form.add_multi",["project"=>$project]);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : addMultiPost(Request, project_id) : redirect(admin/add/projects/{project_id}/multi/{multi_id}/item)
    | URL : /admin/add/project/{project_id}/multi 
    | METHOD : POST
    |--------------------------------------------------
    | ADD NEW MULTI PROJECT ENVIRONMENT.
    |
    */
    public function addMultiPost(Request $request,$project_id)
    {
      $project = Projects::where("project_id",$project_id)->first();
      if($project == null) return redirect("admin")->with("status","No project found");
      $multi = new MultiItems;
      $multi->name = $request->string("name");
      $multi->project_id = $project->id;
      $multi->save();
      $multi->multi_id = StringUtils::base64url_encode("mu-".$multi->id);
      $multi->save();
      return redirect("/admin/add/project/".$project_id."/multi/".$multi->multi_id."/item");
    }
    /*
    |--------------------------------------------------
    | FUNCTION : deleteProject(Request, project_id) : redirect(admin)
    | URL : /admin/delete/project/{project_id}
    | METHOD : GET
    |--------------------------------------------------
    | DELETE A PROJECT
    |
    */
    public function deleteProject(Request $request, $project_id)
    {
      $project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project found");
    	$project->delete();
    	return redirect("admin")->with("status","Deleted project ".$project_id);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : deleteItem(Request, project_id,item_id) : redirect(admin)
    | URL : /admin/delete/project/{project_id}/item/{item_id}
    | METHOD : GET
    |--------------------------------------------------
    | DELETE AN ITEM
    |
    */
    public function deleteItem(Request $request, $project_id,$item_id)
    {
      $project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project found");
    	$item = Items::where(["item_id"=>$item_id,"project"=>$project->id])->first();
    	if($item == null) return redirect("admin")->with("status","No Item found");
      $item->delete();
    	return redirect("admin")->with("status","Deleted item ".$item_id);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : deleteMulti(Request, project_id,multi_id) : redirect(admin)
    | URL : /admin/delete/project/{project_id}/multi/{multi_id}
    | METHOD : GET
    |--------------------------------------------------
    | DELETE A MULTI ENVIORNMENT
    |
    */
    public function deleteMulti(Request $request, $project_id,$multi_id)
    {
      $project = Projects::where("project_id",$project_id)->first();
      if($project == null) return redirect("admin")->with("status","No project found");
      $multi = MultiItems::where(["multi_id"=>$multi_id,"project_id"=>$project->id])->first();
      if($multi == null) return redirect("admin")->with("status","No Enviornment found");
      $multi->delete();
      return redirect("admin")->with("status","Deleted Enviornment ".$multi_id);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : viewItem(Request, project_id,item_id) : view(admin.view.item_view)
    | URL : /admin/view/project/{project}/item/{item}
    | METHOD : GET
    |--------------------------------------------------
    | VIEW AN ITEM FOR ADMINSTRATION
    |
    */
    public function viewItem(Request $request,$project_id,$item_id)
    {
    	// View an item for editing or vieing purpose
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project found");
    	$item = Items::where(["item_id"=>$item_id,"project"=>$project->id])->first();
    	if($item == null) return redirect("admin")->with("status","No Item found");
    	return view("admin.view.item_view",["item"=>$item]);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : viewItem(Request, project_id) : view(admin.view.project_view)
    | URL : /admin/view/project/{project}
    | METHOD : GET
    |--------------------------------------------------
    | VIEW A PROJECT FOR ADMINSTRATION
    |
    */
    public function viewProject(Request $request,$project_id)
    {
    	// View a project for editing,adding or vieing purpose
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project found");
    	
    	return view("admin.view.project_view",["project"=>$project]);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : editItem(Request, project_id,item_id) : view(admin.form.create_item)
    | URL : /admin/edit/project/{project_id}/item/{item_id}
    | METHOD : GET
    |--------------------------------------------------
    | RETUEN FORM TO EDIT AN ITEM
    |
    */
    public function editItem(Request $request,$project_id,$item_id)
    {
      $project = Projects::where("project_id",$project_id)->first();
      if($project == null) return redirect("admin")->with("status","No project with id ".$project_id);
      $item = Items::where("item_id",$item_id)->first();
      if($item == null) return redirect("admin")->with("status","No item with id ".$item_id);
      return view("admin.form.create_item",["edit"=>true,"project"=>$project,"item"=>$item]);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : editItemPost(Request, project_id,item_id) : redirect(admin)
    | URL : /admin/edit/project/{project_id}/item/{item_id}
    | METHOD : POST
    |--------------------------------------------------
    | SAVES DATA SEND FROM THE EDIT ITEM FORM
    */
    public function editItemPost(Request $request,$project_id,$item_id)
    {
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project with id ".$project_id);
    	$item = Items::where(["project"=>$project->id,"item_id"=>$item_id])->first();
    	if($item == null) return redirect("admin")->with("status","No item with id ".$item_id);
    	$item->name = $project->name;
    	$item->version_name = $request->string("version");
    	$item->description = $request->string("description");
    	$item->readme = $request->string("readme");
    	$item->author = $request->string("author");
    	$item->platform = $request->string("platform");
    	$item->view_link = $request->string("view_link");
    	$item->download_link = $request->string("download_link");
    	$item->keywords = $request->string("keywords");
    	$item->image = $request->string("image");
    	$item->author_link = $request->string("author_link");
    	$item->release_name = $request->string("release_name");
    	$item->details = $request->string("details");
    	$item->created_at = $request->date("created_date");
    	$item->downloadable = $request->boolean("is_downloadable");
    	$item->viewable = $request->boolean("is_viewable");
    	$item->is_latest = $request->boolean("is_latest");
    	if($item->is_latest)
    	{
    		$item->latest = $item->id;
    		$project->latestItem()->save($item);
    	}else{
    		try {
    			$latest = Items::where(["project"=>$project->id,"is_latest"=>true])->first()->id;
    			$item->latest = $latest;
    		    $project->latest = $latest;
    		} catch (Exception ) {
    			return redirect("admin/edit/project/".project_id."/item")->with("status","No other latest item found!");
    		}
    	}
    	if(!$project->single_item_project)
    	{
    	  $project->items()->save($item);
    	}
    	$project->save();
    	return redirect("admin")->with("status","Item saved");
    }
    /*
    |--------------------------------------------------
    | FUNCTION : editProject(Request, project_id) : view(admin.form.create_project)
    | URL : /admin/edit/project/{project_id}
    | METHOD : GET
    |--------------------------------------------------
    | RETUEN FORM TO EDIT A PROJECT
    |
    */
    public function editProject(Request $request,$project_id)
    {
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project with id ".$project_id);
    	return view("admin.form.create_project",["edit"=>true,"project"=>$project]);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : editProjectPost(Request, project_id) : redirect(admin)
    | URL : /admin/edit/project/{project_id}
    | METHOD : POST
    |--------------------------------------------------
    | SAVE A REQUEST FROM EDIT PROJECT FORM
    |
    */
    public function editProjectPost(Request $request,$project_id)
    {
    	$validate = $request->validate([
    		"name"=>["required"],
    		"version"=>["required"],
    		"description"=>["required"],
    	]);
    	// Create new project 
    	$code = Hash::make(''.$request->name.$request->version.$request->version_id);
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project ".$project_id);
    	//$project->project_id = $request->string('project_id');
    	$project->name = $request->string("name");
    	$project->description = $request->string("description");
    	$project->version_name = $request->string("version");
    	$project->author = $request->string("author");
    	$project->readme = $request->string("readme");
    	$project->keywords = $request->string("keywords");
    	$project->created_at = $request->date("created_date");
    	$project->platform = $request->string("platform");
    	$project->details = $request->string("details");
    	$project->image = $request->string("image");
    	$project->author_link = $request->string("author_link");
    	$single = $request->boolean("single_item_project");
    	$project->single_item_project = $single;
    	$project->version = 1;
    	$project->user_id = $request->user()->id;
    	$project->save();
    	return redirect("admin")->with("status","Project Edited!");
    }
    /*
    |--------------------------------------------------
    | FUNCTION : newItem(Request, project_id,$multi_id=null) : view(admin.form.create_item)
    | URL : /admin/add/project/{project}/item || /admin/add/project/{project}/multi/{item}/item
    | METHOD : GET
    |--------------------------------------------------
    | RETUEN FORM TO ADD AN ITEM
    |
    */
    public function newItem(Request $request,$project_id,$multi_id=null)
    {
    	// create New item form render
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project with id ".$project_id);
    	if($multi_id != null)
    	{
    	  $multi = MultiItems::where("multi_id",$multi_id)->first();
    	  if($multi == null) return redirect("admin")->with("status","No Multi project environment found");
    	  return view("admin.form.create_item",[
        	"project_id"=>$project_id,
        	"project"=>$project,
        	"multi"=>$multi
    	]); 
    	}
    	else return view("admin.form.create_item",[
        	"project_id"=>$project_id,
        	"project"=>$project
    	]);
    }
    /*
    |--------------------------------------------------
    | FUNCTION : createItem(Request, project_id,$multi_id=null) : redirect(admin)
    | URL : /admin/add/project/{project}/item || /admin/add/project/{project}/multi/{item}/item
    | METHOD : POST
    |--------------------------------------------------
    | SAVE ITEM FROM THE REQUEST SEND FROM THE CREATE FORM
    |
    */
    public function createItem(Request $request,$project_id,$multi_id = null)
    {
    	// create New item form submission;
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project with id ".$project_id);
    	$pre_item = Items::where(["project"=>$project->id,"version_name"=>$request->string("version"),])->first();
    	if($pre_item != null) return back()->with("status","An item with same version name already exists");
    	$pre_item = Items::where(["project"=>$project->id,"release_name"=>$request->string("release_name"),])->first();
    	if($pre_item != null) return back()->with("status","An item with same release name already exists");
    	$pre_item = Items::where(["project"=>$project->id,"is_latest"=>true])->first();
    	if($pre_item == null) $version = 1;
    	else $version = $pre_item->version ++;
    	$item = new Items;
    	$item->name = $project->name;
    	$item->version_name = $request->string("version");
    	$item->description = $request->string("description");
    	$item->readme = $request->string("readme");
    	$item->author = $request->string("author");
    	$item->platform = $request->string("platform");
    	$item->view_link = $request->string("view_link");
    	$item->download_link = $request->string("download_link");
    	$item->keywords = $request->string("keywords");
    	$item->image = $request->string("image");
    	$item->author_link = $request->string("author_link");
    	$item->release_name = $request->string("release_name");
    	$item->details = $request->string("details");
    	$item->created_at = $request->date("created_date");
    	$item->downloadable = $request->boolean("is_downloadable");
    	$item->viewable = $request->boolean("is_viewable");
    	$item->is_latest = $request->boolean("is_latest");
    	$item->project = $project->id;
    	$item->user_id = $request->user()->id;
    	
    	$item->version = $version;
    	
    	$item->save();
    	$item_id = StringUtils::base64url_encode("pr-".$project->id.$item->id);
    	$item->item_id = $item_id;
    	if($item->is_latest)
    	{
    		$item->latest = $item->id;
    		$project->latest = $item->id;
    		if($multi_id !=null)
      	{
      	  $multi = MultiItems::where("multi_id",$multi_id)->first();
      	  if($multi == null) return redirect("admin")->with("status","No Multi project environment found");
      	  $multis = Items::where("multi_id",$multi->id)->get();
      	  foreach ($multis as $mul)
      	  {
      	    $mul->is_latest = false;
      	    $mul->latest = $item->id;
      	    $mul->save();
      	  }
      	}
    	}else{
    		try {
    			$latest = Items::where(["project"=>$project->id,"is_latest"=>true])->first()->id;
    			$item->latest = $latest;
    		    $project->latest = $latest;
    		} catch (Exception ) {
    			return redirect("admin/add/project/".project_id."/item")->with("status","No other latest item found!");
    		}
    	}
    	if($multi_id !=null)
    	{
    	  $multi = MultiItems::where("multi_id",$multi_id)->first();
    	  if($multi == null) return redirect("admin")->with("status","No Multi project environment found");
    	  $item->multi_id = $multi->id;
    	}
    	$item->save();
    	$project->save();
    	return redirect("admin")->with("status","Item saved");
    }
    /*
    |--------------------------------------------------
    | FUNCTION : newProject(Request) : view(admin.form.create_project)
    | URL : /admin/add/project
    | METHOD : GET
    |--------------------------------------------------
    | RETURN FORM FOR CREATING A PROJECT
    |
    */
    public function newProject(Request $request)
    {
    	// Create new project form render
    	return view('admin.form.create_project');
    }
    /*
    |--------------------------------------------------
    | FUNCTION : createProject(Request) : view(admin.form.create_project)
    | URL : /admin/add/project
    | METHOD : POST
    |--------------------------------------------------
    | SAVES A PROJRCT FROM THE REQUEST FORM
    |
    */
    public function createProject(Request $request)
    {
    	$validate = $request->validate([
    		"project_id"=>["required","unique:projects"],
    		"name"=>["required"],
    		"version"=>["required"],
    		"description"=>["required"],
    	]);
    	// Create new project 
    	$code = Hash::make(''.$request->name.$request->version.$request->version_id);
    	$project = new Projects;
   
    	$project->project_id = $request->string('project_id');
    	$project->name = $request->string("name");
    	$project->description = $request->string("description");
    	$project->version_name = $request->string("version");
    	$project->author = $request->string("author");
    	$project->readme = $request->string("readme");
    	$project->keywords = $request->string("keywords");
    	$project->created_at = $request->date("created_date");
    	$project->platform = $request->string("platform");
    	$project->details = $request->string("details");
    	$project->image = $request->string("image");
    	$project->author_link = $request->string("author_link");
    	$single = $request->boolean("single_item_project");
    	$project->single_item_project = $single;
    	$project->version = 1;
    	$project->user_id = $request->user()->id;
    	$project->save();
    	if($single){
    		return redirect("admin/add/project/".$project->project_id."/item")->with("status","Project Created!");
    	}
    	return redirect("admin")->with("status","Project Created!");
    }
}