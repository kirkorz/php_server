<?php
require_once('controllers/base_controller.php');
require_once('models/question.php');
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
  public function login()
  {
    $data = array(
      'username' => $_POST["txtusername"],
      'password' => $_POST["txtpassword"]
    );
    $url = 'http://localhost:3000/auth/login';
    $ch = curl_init($url);
    $postString = http_build_query($data,'','&');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    session_start();
    $_SESSION['token'] = $result["accessToken"];
    $data = array(
      'name' => 'Not Guest',
      'questions'=> Question::all()
    );
    $this->render('index',$data);
  }
  public function logout(){
    session_start();
    session_destroy();
    $data = array(
      'name' => 'Sang Beo',
      'age' => 22,
      'questions'=> Question::all()
    );
    $this->render('index',$data);
  }
  public function dashboard(){
    session_start();
    $data = array(
      'name' => 'Not Guest',
      'questions'=> Question::myquestion()
    );
    $this->render('index',$data);
  }
}