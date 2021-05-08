<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');
require_once('models/user.php');
class AuthController extends BaseController
{
  function __construct()
  {
    $this->folder = 'auth';
  }

  // public function loginGoogle(){
  //   $result = User::loginGoogle();
  //   header('Location: '.$result[url]);
  // }

  public function index()
  {
    $this->render('login');
  } 
  public function index2(){
    $this->render('signup');
  }
  public function login($data=null)
  {
    if(!isset($data)){
      $data = array(
        'username' => $_POST["txtusername"],
        'password' => $_POST["txtpassword"]
      );
    }
    $result = User::login($data);
    $_SESSION['token'] = $result["accessToken"];
    $_SESSION['role'] = $result["role"];
    if($_SESSION['role'] == 'admin'){
      $result = Question::notcheck();
      $data = array(
        'questions'=> $result['result'],
        'count' => $result['count']
      );
      $this->render('',$data,'views/landing/mod.php');
    } else{
      $result = Question::private();
      $data = array(
        'questions'=> $result['result'],
        'count' => $result['count']
      );
      $this->render('',$data,'views/landing/dashboard.php');
    }
  }
  public function signup(){
    $data = array(
      'username' => $_POST["txtusername"],
      'name'=> $_POST['txtname'],
      'password' => $_POST["txtpassword"],
      'role' => 'user'
    );
    $result = User::signup($data);
    if($result == 200){
      $this->login($data);
    }
    else{
      $this->index2();
    }
    
  }
  public function logout(){
    session_start();
    session_destroy();
    $result = Question::all();
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count']
    );
    $this->render('',$data,'views/landing/index.php');
  }
}