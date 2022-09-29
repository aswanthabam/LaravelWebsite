<?php
namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table = "projects";
    protected $primary_key = "id";
    const CREATED_AT = "added_on";
    const UPDATED_AT = "changed_on";
    protected $dateFormat = "Y-m-d H:i:s";
    
    protected $fillable = [
    	"project_id",
    	"name",
    	"version_name",
    	"description",
    	"readme",
    	"author",
    	"platform",
    	"keywords",
    	"image",
    	"author_link",
    	"details"
    ];
    
    protected $casts = [
    	"version"=>"integer",
    	"created_at"=>"datetime",
    	"updated_at"=>"datetime",
    	"downloads"=>"integer",
    	"likes"=>"integer",
    	"item_count"=>"integer",
    	"is_latest"=>"boolean",
    	"single_item_project"=>"boolean",
    ];
    public function multi()
    {
      return $this->hasMany(MultiItems::class,"project_id");
    }
    public function allItems()
    {
      return $this->hasMany(Items::class,"project_id");
    }
    public function user_id()
    {
    	return $this->hasOne(User::class);
    }
    public function latestItem()
    {
    	return $this->belongsTo(Items::class,"latest");
    }
    public function items()
    {
    	return $this->hasMany(Items::class);
    }
}
