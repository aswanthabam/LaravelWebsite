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
  public static function base64url_encode($data)
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
  public static function base64url_decode($data, $strict = false)
  {
    // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
    $b64 = strtr($data, '-_', '+/');

    // Decode Base64 string and return the original data
    return base64_decode($b64, $strict);
  }
}