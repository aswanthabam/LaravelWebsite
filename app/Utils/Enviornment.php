<?php

namespace App\Utils;

use App\Models\Projects;
use App\Models\Items;
use App\Models\MultiItems;

class Environment
{
  $multi = null;
  $project = null;
  public function __construct($multi)
  {
    $this->project = $multi->project;
    $this->multi = $multi;
  }
  
  public function latest()
  {
    if($multi == null) return null;
    try{
      return $multi->items()->where("is_latest",true)->first();
    } catch (Exception $e){
      return null;
    }
  }
  public function items()
  {
    if($multi == null) return null;
    try{
      return $multi->items->orderByDesc("ADDED_ON")->get();
    } catch (Exception $e){
      return null;
    }
  }
  
  public function update()
  {
    
  }
  
  public function edit()
  {
    
  }
  
  public function __toString()
  {
    return $this->multi;
  }
}