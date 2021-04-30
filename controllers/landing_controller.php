<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');

class LandingController extends BaseController
{
  function __construct()
  {
    $this->folder = 'landing';
  }

  public function userindex($page=0)
  {
    $result = Question::all($page);
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
    session_start();
    $result = Question::private($page);
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count'],
      'conact' => "/?controller=landing&action=dashboard" 
    );
    $this->render('dashboard',$data);
  }

  
  public function addQuestion()
  {
    session_start();
    Question::addQuestion($_POST['txttitle'],$_POST['txtdetail'],$_POST['txttags']);
    $result = Question::private();
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count'],
      'conact' => "/?controller=landing&action=dashboard" 
    );
    $this->render('dashboard', $data);
  }

  public function searchQuestion($page=0)
  {
    session_start();
    $result = Question::searchQuestion($_POST['txtsearch'],$page); 
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count'],
      'conact' => "/?controller=landing&action=searchQuestion" 
    );
    $this->render('userindex', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}