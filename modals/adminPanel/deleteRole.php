<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataRole=$_POST['dataRole'];
        $msg="";
        $code=200;
        
        $deleteRole=delete("roles", "id_roles", $dataRole);
        
        if($deleteRole){
           $roles=getAllFromTabel("roles");
           $msg=$roles;
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