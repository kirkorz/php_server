<?php
class Answer
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
  
  static function all($id,$skip=0,$limit=5){
    $data = array(
      'skip'=> $skip,
      'limit'=> $limit
    );
    $url = self::$domain.'/api/answers/'.$id;
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

  static function addComment($node_id,$comment){
    $data = array(
      'token' => $_SESSION['token'],
      'nodeId' => $node_id,
      'comment' => $comment
    );
    $url = self::$domain.'/api/answers';
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