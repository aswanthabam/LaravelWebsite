<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use Illuminate\Support\Facades\Hash;
use App\Models\Items;
class ProjectsController extends Controller
{
    public function viewItem(Request $request,$project,$item)
    {
    	// View an item for editing or vieing purpose
    	return $project." | ".$item;
    }
    public function viewProjecr(Request $request,$project)
    {
    	// View a project for editing,adding or vieing purpose
    	return $project;
    }
    public function newItem(Request $request,$project_id)
    {
    	$project = Projects::where("project_id",$project_id)->first();
    	if($project == null) return redirect("admin")->with("status","No project with id ".$project_id);
    	$request->session()->flash("description",$project->description);
    	$request->session()->flash("author",$project->author);
    	$request->session()->flash("keywords",$project->keywords);
    	$request->session()->flash("created_at",$project->created_at);
    	$request->session()->flash("platform",$project->platform);
    	$request->session()->flash("details",$project->details);
    //	return "".$probj->name;
    	// create New item form render
    	return view("admin.form.create_item",[
        	"project_id"=>$project_id,
        	"project"=>$project
    	]);
    }
    public function createItem(Request $request,$project_id)
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
    	$item->release_name = $request->string("release_name");
    	$item->details = $request->string("details");
    	$item->created_at = $request->date("created_at");
    	$item->downloadable = $request->boolean("is_downloadable");
    	$item->viewable = $request->boolean("is_viewable");
    	$item->is_latest = $request->boolean("is_latest");
    	$item->project = $project->id;
    	$item->user_id = $request->user()->id;
    	
    	$item->version = $version;
    	
    	$item->save();
    	$item_id = base64url_encode("pr-".$project->id.$item->id);
    	$item->item_id = $item_id;
    	if($item->is_latest)
    	{
    		$item->latest = $item->id;
    	}else{
    		try {
    			$item->latest = Items::where(["project"=>$project->id,"is_latest"=>true])->first()->id;
    		} catch (Exception ) {
    			return redirect("admin/add/project/".project_id."/item")->with("status","No other latest item found!");
    		}
    	}
    	$item->save();
    	return $item;
    }
    public function newProject(Request $request)
    {
    	// Create new project form render
    	return view('admin.form.create_project');
    }
    
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


function base64url_encode($data)
{
  // First of all you should encode $data to Base64 string
  $b64 = base64_encode($data);

  // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
  if ($b64 === false) {
    return false;
  }

  // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
  $url = strtr($b64, '+/', '-_');

  // Remove padding character from the end of line and return the Base64URL result
  return rtrim($url, '=');
}

/**
 * Decode data from Base64URL
 * @param string $data
 * @param boolean $strict
 * @return boolean|string
 */
function base64url_decode($data, $strict = false)
{
  // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
  $b64 = strtr($data, '-_', '+/');

  // Decode Base64 string and return the original data
  return base64_decode($b64, $strict);
}