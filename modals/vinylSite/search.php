<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $valueS=$_POST['valueS'];
        $msg="";
        $code=200;
        
        $valueSearch=search($valueS);
        if($valueSearch){
           $msg=$valueSearch;
           $code=200;
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