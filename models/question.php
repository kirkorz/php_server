<?php
class Question
{

  // public static $domain = "https://udpt15-content.herokuapp.com";
  public static $domain = "http://127.0.0.1:3001";

  public $id;
  public $title;
  public $content;

  function __construct($id, $title, $content)
  {
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
  }

  static function all($category= null,$skip = 0,$limit = 5){
    $data = array(
      'category' => $category,
      'skip' => $skip ,
      'limit' => $limit
    );
    $url = self::$domain.'/api/questions/all';
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($result,$httpcode);
  }
  static function detail($id){
    $url = self::$domain.'/api/questions/'.$id;
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($ch);
    $result = json_decode($response, true)[0];
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }
  static function notcheck($skip = 0){
    $data = array(
        'skip' => $skip * 5,
        'token' => $_SESSION['token']
    );
    $url = self::$domain.'/mod/questions';
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }
  static function private($skip = 0){
    $data = array(
        'skip' => $skip * 5,
        'token' => $_SESSION['token']
    );
    $url = self::$domain.'/api/questions/private';
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($result,$httpcode);
  }

  static function addQuestion($title,$detail,$tags){
    $data = array(
      'token' => $_SESSION['token'],
      'title' => $title,
      'detail' => $detail,
      'tags' => $tags
    );
    $url = self::$domain.'/api/questions';
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

  static function makepub($id){
    $data = array(
      'token' => $_SESSION['token'],
      'questionsId' => $id
    );
    $url = self::$domain.'/mod/questions';
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

  static function addCategory($id,$category){
    $data = array(
      'token' => $_SESSION['token'],
      'questionsId' => $id,
      'category' => $category,
    );
    $url = self::$domain.'/mod/questions/category';
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

  static function deleteQuestion($id){
    session_start();
    $data = array(
      'token' => $_SESSION['token']
    );
    $url = self::$domain.'/api/questions/'.$id;
    $ch = curl_init($url);
    $postString = http_build_query($data,'','&');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    // curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }
  static function moddelQuestion($id){
    $data = array(
      'token' => $_SESSION['token'],
      'questionsId' => $id
    );
    $url = self::$domain.'/mod/questions/';
    $ch = curl_init($url);
    $postString = http_build_query($data,'','&');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    // curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }
  static function searchQuestion($text, $skip = 0){
    session_start();
    $data = array(
        'skip' => $skip * 5,
        'text' => $text
    );
    $url = self::$domain.'/api/questions/search';
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }
  static function makeVote($token,$id,$vote){
    $data = array(
      'token' => $token,
      'objectId' => $id,
      'upVote' => $vote,
    );
    $url = self::$domain.'/api/votes/vote';
    $ch = curl_init($url);
    $postString = http_build_query($data,'','&');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($result,$httpcode);
  }
}