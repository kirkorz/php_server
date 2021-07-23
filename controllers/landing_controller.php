<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');

class LandingController extends BaseController
{
  function __construct()
  {
    $this->folder = 'landing';
  }

  public function userindex(){
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $skip = isset($_GET['skip']) ? $_GET['skip']: 0 ;
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 5 ;
    list($result,$nothing) = Question::all($category,$skip,$limit);
      $data = array(
        'questions'=> $result['result'],
        'count' => $result['count'],
        'conact' => "/?controller=landing&action=userindex" 
      );
    $this->render('index', $data);
  }

  public function modindex($page=0){
    $result = Question::notcheck($page);
      $data = array(
        'questions'=> $result['result'],
        'count' => $result['count'],
        'conact' => "/?controller=landing&action=modindex" 
      );
    $this->render('mod', $data);
  }

  public function dashboard($page=0){
    list($result,$statuscode) = Question::private($page);
    if($statuscode != 200){
      session_destroy();
      header('Location: '."/");
      exit();
    }
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count'],
      'conact' => "/?controller=landing&action=dashboard" 
    );
    $this->render('dashboard',$data);
  }
  
  public function addQuestion(){
    Question::addQuestion($_POST['txttitle'],$_POST['txtdetail'],$_POST['txttags']);
    header('Location: '."/?controller=landing&action=dashboard");
  }

  public function searchQuestion($skip=0,$limit=5){
    $result = Question::searchQuestion($_POST['txtsearch'],$skip,$limit); 
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count'],
      'conact' => "/?controller=landing&action=searchQuestion" 
    );
    $this->render('index', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}