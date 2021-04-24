<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');

class LandingController extends BaseController
{
  function __construct()
  {
    $this->folder = 'landing';
  }

  public function index()
  {

    $data = array(
      'name' => 'Guest',
      'questions'=> Question::all()
    );
    $this->render('index', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}