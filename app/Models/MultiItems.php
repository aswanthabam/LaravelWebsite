<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiItems extends Model
{
    use HasFactory;
    protected $table = "multi_items";
    const CREATED_AT = "ADDED_ON";
    const UPDATED_AT = "CHANGED_ON";
    protected $dateFormat = "Y-m-d H:i:s";
    
    protected $fillable = [
      "name"
    ];
    
    public function project()
    {
      return $this->belongsTo(Projects::class,"project_id");
    }
    public function item()
    {
      return $this->hasMany(Items::class,"multi_id");
    }
}
