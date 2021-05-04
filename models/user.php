<?php
class User
{
  public $id;
  public $title;
  public $content;

  function __construct($id, $title, $content)
  {
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
  }
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
    $url = 'https://udpt15-auth.herokuapp.com/users/signup';
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
    $url = 'https://udpt15-auth.herokuapp.com/users/login';
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