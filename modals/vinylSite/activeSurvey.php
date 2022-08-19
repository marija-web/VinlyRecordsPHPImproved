<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $value=$_POST['value'];
        $check=$_POST['check'];

        $msg="";
        $code=200;
        
        $activeNoActive=activeNoActive($value, $check);
        if($activeNoActive){
           $msg=$activeNoActive;
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