<?php

namespace App\Utils;

use App\Models\Projects;
use App\Models\Items;
use App\Models\MultiItems;

class Project
{
  public $project = null;
  
  public function __construct($pro = null)
  {
    $this->project = $pro;
  }
  public function from($project)
  {
    if($project==null) return false;
    $this->project = $project;
  }
  public function latest()
  {
    if($this->project != null)
    {
      try{
        return $this->project->latest;
      } catch (Exception $e) {
        return null;
      }
    }else return null;
  }
  public function user()
  {
    if($this->project != null)
    {
      try{
        return $this->project->user;
      } catch (Exception $e) {
        return null;
      }
    }else return null;
  }
  
  public function is_multi()
  {
    return !$this->project->single_item_project;
  }
  
  public function get_enviornments()
  {
    if(!$this->is_multi()) return null;
    $ar = [];
    foreach($this->multi as $mu) array_push($ar,new Enviornment($mu));
    return $mu;
  }
  
  public function get_enviornment($multi_id)
  {
    if(!$this->is_multi() || $multi_id == null) return null;
    return new Enviornment($this->multi->where("multi_id",$multi_id)->get());
  }
  /*
  |--------------------------------------------------
  | FUNCTION : create_project(Project,Request,is_new) : boolean
  | URL : NONE
  | METHOD : NONE
  |--------------------------------------------------
  | SAVES A PROJRCT FROM THE REQUEST
  |
  */
  public static function create_project($project,$request,$new=false)
  {
    try {
      if($new) $project->project_id = $request->string('project_id');
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
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
  /*
  |--------------------------------------------------
  | FUNCTION : get_project(project_id) : Projects
  | URL : NONE
  | METHOD : NONE
  |--------------------------------------------------
  | GETS A PROJECT USING ITS PROJECT_ID
  |
  */
  public static function get_project($project_id)
  {
    return Projects::where("project_id",$project_id)->first();
  }
  
  public function __toString()
  {
    return $this->project;
  }
}