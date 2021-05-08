<?php
class Question
{

  public static $domain = "https://udpt15-content.herokuapp.com";
  public $id;
  public $title;
  public $content;

  function __construct($id, $title, $content)
  {
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
  }

  static function all($skip = 0)
  {
    $data = array(
      'skip' => $skip * 5
    );
    $url = self::$domain.'/api/public/questions/all';
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }
  static function detail($id){
    $url = self::$domain.'/api/public/questions/'.$id;
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
    session_start();
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
    return $result;
  }

  static function addQuestion($title,$detail,$tags){
    session_start();
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
    session_start();
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
    session_start();
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
    session_start();
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
    $url = self::$domain.'/api/public/questions/search';
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
}