<?php
require_once('models/question.php');
require_once('models/answer.php');
class ApiController 
{
    public function getQuestions(){
        $category = $_GET['category'];
        $skip = intval($_GET['skip']); 
        $limit = intval($_GET['limit']); 
        list($data,$n) = Question::all($category,$skip,$limit);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function makeVotes(){
        $id = isset($_GET['object']) ? $_GET['object'] : null; 
        $vote = isset($_GET['vote']) ? intval($_GET['vote']) : null;
        if(!$id || !$vote || !isset($_SESSION['token'])){
            header('HTTP/1.1 500 Internal Server Error');
        }
        else{
            list($data,$n) = Question::makeVote($_SESSION['token'],$id,$vote);
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
    public function getAnswers(){
        $id = $_GET['id'];
        $skip = intval($_GET['skip']); 
        $limit = intval($_GET['limit']);
        $noibat = isset(($_GET['noibat'])) && ($_GET['noibat'] == 'true') ? true  : false;
        list($data,$n) = Answer::all($id,$skip,$limit,$noibat);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}