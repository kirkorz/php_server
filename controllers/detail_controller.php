<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');
require_once('models/answer.php');
require_once('controllers/landing_controller.php');

class DetailController extends BaseController
{
  function __construct()
  {
    $this->folder = 'detail';
  }

  public function index($id)
  {
    list($comment,$n) = Answer::all($id);
    $data = array(
      'question'=> Question::detail($id),
      'answers' => $comment['result'],
      'count' => $comment['count'],
      'conact' => "/?controller=detail&action=index" 
    );
    $_SESSION['node_id'] = $id;
    $this->render('index', $data);
  }
  public function addComment($id){
    list($ans,$n) =  Answer::addComment($id,$_POST['txtcomment']);
    if($n != 200){
      session_destroy();
    }
    // $comment = Answer::all($id);
    // $data = array(
    //   'question'=> Question::detail($id),
    //   'answers' => $comment['result'],
    //   // 'count' => $comment['count']['page_of_comment'],
    //   'count' => $comment['count'],
    //   'conact' => "/?controller=detail&action=index" 
    // );
    // $this->render('index', $data);
    header('Location: '."/?controller=detail&action=index&id=".$id);
  }

  public function deleteQuestion($id){
    Question::deletequestion($id);
    header('Location: '."/?controller=landing&action=dashboard");
  }

  public function moddelQuestion($id){
    Question::moddelQuestion($id);
    header('Location: '."/?controller=landing&action=modindex");
  }

  public function makepub($id){
    Question::makepub($id);
    header('Location: '."/?controller=landing&action=modindex");
  }

  public function addcategory($id){
    Question::addCategory($id,$_POST['txtcategory']);
    header('Location: '."/?controller=landing&action=modindex");
  }

  public function error(){
    $this->render('error');
  }
}