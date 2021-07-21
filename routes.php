<?php
$controllers = array(
  'landing' => ['userindex','modindex', 'error','addQuestion','searchQuestion','dashboard'],
  'detail' => ['index','error','addComment','deleteQuestion','makepub','moddelQuestion','addcategory'],
  'auth' => ['index','login','logout','dashboard','signup','index2','loginGoogle'],
  'questions' => ['publiclist','privatelist'],
  'api' => ['getQuestions','getAnswers','makeVotes'],
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $controller = 'landing';
  $action = 'error';
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controllers/' . $controller . '_controller.php');
// Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
if(isset($_REQUEST['id'])){
  if(isset($_REQUEST['page'])){
    $controller->$action($_REQUEST['id'],$_REQUEST['page']);  
  }
  else{
    $controller->$action($_REQUEST['id']);
  }
} else{
  $controller->$action();
}

