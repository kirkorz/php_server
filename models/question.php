<?php
class Question
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

  static function all()
  {
    $url = 'http://localhost:3000/api/questions';
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $list = $result;
    return $list;
  }
  static function detail($id){
    $url = 'http://localhost:3000/api/questions/public/'.$id;
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($ch);
    $result = json_decode($response, true)[0];
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $detail = $result;
    return $detail;
  }
  static function myquestion(){
    session_start();
    $data = array(
        'token' => $_SESSION['token']
    );
    $url = 'http://localhost:3000/api/questions/private';
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

  static function addcomment($node_id,$comment){
    session_start();
    $data = array(
      'token' => $_SESSION['token'],
      'node_id' => $node_id,
      'comment' => $comment
    );
    $url = 'http://localhost:3000/api/answers';
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