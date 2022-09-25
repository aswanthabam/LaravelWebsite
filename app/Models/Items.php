<?php

namespace App\Models;
use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $table = "items";
    protected $primary_key = "item_id";
    const CREATED_AT = "ADDED_ON";
    const UPDATED_AT = "CHANGED_ON";
    protected $dateFormat = "Y-m-d H:i:s";
    
    protected $fillable = [
    	"item_id",
    	"name",
    	"version_name",
    	"description",
    	"readme",
    	"author",
    	"platform",
    	"download_link",
    	"view_link",
    	"keywords",
    	"release_name",
    	"base64eq",
    	"image",
    	"author_link"
    ];
    protected $casts = [
    	"version"=>"integer",
    	"created_at"=>"datetime",
    	"updated_at"=>"datetime",
    	"downloads"=>"integer",
    	"likes"=>"integer",
    	"downloadable"=>"boolean",
    	"viewable"=>"boolean",
    	"is_latest"=>"boolean",
    	"details"=>Json::class
    ];
    public function user_id()
    {
    	return $this->hasOne(User::class);
    }
    public function latest()
    {
    	return $this->hasOne(Items::class,"latest");
    }
    public function project()
    {
    	return $this->belongsTo(Projects::class,"latest");
    }
}
