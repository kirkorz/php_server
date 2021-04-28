<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');

class QuestionsController extends BaseController
{
  function __construct()
  {
    $this->folder = 'questions';
  }

  public function publiclist($page=0)
  {
    $result = Question::all($page);
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count']
    );
    $this->render('list', $data);
  }
  public function privatelist($page=0){
    $result = Question::private($page);
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count']
    );
    echo "aaa";
    $this->render('list', $data);
  }

//   public function addQuestion()
//   {
//     session_start();
//     Question::addQuestion($_POST['txttitle'],$_POST['txtdetail']);
//     $data = array(
//       'questions'=> Question::private(),
//     );
//     $this->render('index', $data,'views/auth/dashboard.php');
//   }

  public function error()
  {
    $this->render('error');
  }
}