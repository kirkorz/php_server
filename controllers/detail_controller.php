<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');
require_once('models/answer.php');

class DetailController extends BaseController
{
  function __construct()
  {
    $this->folder = 'detail';
  }

  public function index($id,$page=1)
  {
    $comment = Answer::all($id,$page);
    $data = array(
      'question'=> Question::detail($id),
      'answers' => $comment['result'],
      'count' => $comment['count']['page_of_comment'],
      'conact' => "/?controller=detail&action=index" 
    );
    session_start();
    $_SESSION['node_id'] = $id;
    $this->render('index', $data);
  }
  public function addComment($id){
    session_start();
    Answer::addComment($id,$_POST['txtcomment']);
    $comment = Answer::all($id);
    $data = array(
      'question'=> Question::detail($id),
      'answers' => $comment['result'],
      'count' => $comment['count']['page_of_comment'],
      'conact' => "/?controller=detail&action=index" 
    );
    $this->render('index', $data);
  }

  public function deleteQuestion($id){
    session_start();
    Question::deletequestion($id);
    $result = Question::private();
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count']
    );
    //$this->render('index', $data);
    $this->render('', $data,'views/auth/dashboard.php');
  }
  
  public function error()
  {
    $this->render('error');
  }
}