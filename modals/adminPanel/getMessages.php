<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='GET'){
        include "../functions.php";
        $msg="";
        $code=200;
        
        $messages=messagesReturn();
        if($messages){   
           $msg=$messages;
           $code=200;
        }
        else{
            $msg="Server error.";
            $code=500;
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