<?php
class User
{
  static $domain = "https://udpt15-auth.herokuapp.com";
  
  // static function loginGoogle(){
  //   $url = 'http://localhost:3000/users/google';
  //   $ch = curl_init($url);
  //   curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //   $response = curl_exec($ch);
  //   $result = json_decode($response, true);
  //   $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //   curl_close($ch);
  //   return $result;
  // }
  static function signup($data){
    $url = $domain.'/users/signup';
    $ch = curl_init($url);
    $postString = http_build_query($data,'','&');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpcode;
  }

  static function login($data){
    $url = $domain.'/users/login';
    $ch = curl_init($url);
    $postString = http_build_query($data,'','&');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }
}