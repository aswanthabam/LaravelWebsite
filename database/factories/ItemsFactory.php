<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Items>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      $detail = "{";
        $mm = random_int(3,6);
        for($i = 0;$i < $mm;$i++)
        {
          
          $key = Str::random(random_int(3,8));
          $value = Str::random(random_int(5,10));
          $detail = $detail."\"".$key."\":\"".$value."\"";
          if($i != $mm) $detail = $detail.",";
          else $detail = $detail."}";
        }
        $keywords = "";
        for($i = 0;$i < $mm;$i++) $keywords = $keywords.Str::random(random_int(3,6)).", ";
        return [
          "project_id"=>Str::random(10),
          "name"=>Str::random(10),
          "version_name"=>"v".random_int(0,9).".".random_int(0,9).".".random_int(0,9),
          "description"=>Str::random(300),
          "readme"=>Str::random(1000),
          "author"=>Str::random(10),
          "platform"=>Str::random(5),
          "details"=>$detail,
          "keywords"=>$keywords,
          "created_at"=>date("Y-m-d H:i:s"),
          "updated_at"=>date("Y-m-d H:i:s"),
          "added_on"=>date("Y-m-d H:i:s"),
          "changed_on"=>date("Y-m-d H:i:s"),
          "version"=>random_int(1,20),
          "author_link"=>"https://google.com",
          "project"=>"Null",
          "release_name"=>Str::random(10),
        ];
    }
}
