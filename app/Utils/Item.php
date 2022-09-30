<?php 

namespace App\Utils;

use App\Models\Projects;
use App\Models\Items;
use App\Models\MultiItems;

class Item
{
  public $item = null;
  public function __construct($item)
  {
    $this->item = $item;
  }
  public function __toString()
  {
    return $this->item;
  }
}