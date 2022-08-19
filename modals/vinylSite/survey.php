<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $id=$_POST['id'];
        $value=$_POST['value'];
        $user=$_POST['user'];
        $msg="";
        $code=200;
        
        $answerSurvey=alreadyAnswered($id, $user);
        if(count($answerSurvey)){
            $msg="You have already answered.";
        }
        else{
            $sendSurvey=sendSurvey($value, $user);
            if($sendSurvey){
                $msg="Thank you for your feedback.";
                $code=201;
            }
      
        }
    http_response_code($code);
    echo json_encode($msg);
    }
    else{
        header("location: ../404Page.php?notFound");
        $code=404;
        $msg="Page not found.";
    }
    
?>