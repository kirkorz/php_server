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
      $newURL = "/?controller=landing&action=modindex";
    } else{
      $newURL = "http://127.0.0.1:5000/?controller=landing&action=dashboard";
      // $result = Question::private();
      // $data = array(
      //   'questions'=> $result['result'],
      //   'count' => $result['count']
      // );
      // $this->render('',$data,'views/landing/dashboard.php');
    }
    header('Location: '.$newURL);
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
    session_destroy();
    $result = Question::all();
    $data = array(
      'questions'=> $result['result'],
      'count' => $result['count']
    );
    header('Location: '."http://127.0.0.1:5000/");
    // $this->render('',$data,'views/landing/index.php');
  }
}