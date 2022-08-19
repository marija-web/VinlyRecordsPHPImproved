<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataRole=$_POST['dataRole'];
        $nameRole=$_POST['nameRole'];

        $msg="";
        $code=200;
        
        $updateRoleUser=updateRoleUser($dataRole, $nameRole);
        if($updateRoleUser){
           $rolesUser=getAllFromTabel("roles");
           $msg=$rolesUser;
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