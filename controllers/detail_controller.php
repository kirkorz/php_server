<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');

class DetailController extends BaseController
{
  function __construct()
  {
    $this->folder = 'detail';
  }

  public function index($id)
  {
    $data = array(
      'question'=> Question::detail($id)
    );
    session_start();
    $_SESSION['node_id'] = $id;
    $this->render('index', $data);
  }
  public function addcomment(){
    session_start();
    Question::addcomment($_SESSION['node_id'],$_POST['txtcomment']);
    $data = array(
      'question'=> Question::detail($_SESSION['node_id'])
    );
    $this->render('index', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}