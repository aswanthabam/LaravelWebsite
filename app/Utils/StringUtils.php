<?php
namespace App\Utils;
use Illuminate\Support\Str;

class StringUtils
{
  public static function paragraph($words)
  {
      $para = "";
      for($i = 0;$i < $words;$i++)
      {
        if($i != 0) $para = $para." ";
        $para = $para.Str::random(random_int(3,7));
      }
      return $para;
  }
}