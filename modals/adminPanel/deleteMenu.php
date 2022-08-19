<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataMenu=$_POST['dataMenu'];
        $msg="";
        $code=200;
        
        $deleteMenu=deleteMenu($dataMenu);
        
        if($deleteMenu){
           $menu=getAllFromTabel("menu");
           $msg=$menu;
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