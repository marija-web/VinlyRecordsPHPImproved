<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $nameAdmin=$_POST['nameAdmin'];
        $lastNameAdmin=$_POST['lastNameAdmin'];
        $emailAdmin=$_POST['emailAdmin'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameAdmin=="" || $lastNameAdmin=="" || $emailAdmin==""){
            $valid=false;
        }

        if($valid){
            $updateA=updateAdmin($nameAdmin, $lastNameAdmin, $emailAdmin);
        }

        if($updateA){
            $msg="You have successfully updated your profile!";
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