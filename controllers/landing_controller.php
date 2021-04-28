<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');

class LandingController extends BaseController
{
  function __construct()
  {
    $this->folder = 'landing';
  }

  public function index($page=0)
  {
    // load questions at home page
    $result = Question::all($page);
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count'],
      'conact' => "/?controller=landing&action=index" 
    );
    $this->render('index', $data);
  }

  public function addQuestion()
  {
    session_start();
    Question::addQuestion($_POST['txttitle'],$_POST['txtdetail']);
    $result = Question::private();
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count'],
      'conact' => "/?controller=auth&action=dashboard" 
    );
    $this->render('index', $data,'views/auth/dashboard.php');
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
    $this->render('index', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}