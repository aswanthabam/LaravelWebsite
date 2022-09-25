<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Items;
use Michelf\Markdown;

class ProjectsControllerPublic extends Controller
{
	public function viewProject(Request $request,$project_id)
	{
		$project = Projects::where("project_id",$project_id)->first();
		if($project == null) return redirect("projects")->with("status","No project found");
		$items = Items::where("project",$project->id)->get();
		return view("projects.project_view",["project"=>$project,"items"=>$items]);
	}
	public function viewItem(Request $request,$project_id,$item_id=null)
	{
		if($item_id != null)
		{
			$project = Projects::where("project_id",$project_id)->first();
			if($project == null) return redirect("projects")->with("status","No project found");
			$item = Items::where(["project"=>$project->id,"item_id"=>$item_id])->first();
		}
		else 
		{
			$item = Items::where(["item_id"=>$project_id])->first();
		}
		if($item == null) return redirect("projects")->with("status","No item found");
		$project = $item->project;
		//$my_html = Markdown::defaultTransform("# Hello");
		return view("projects.item_view",["project"=>$project,"item"=>$item]);
	}
	
}
