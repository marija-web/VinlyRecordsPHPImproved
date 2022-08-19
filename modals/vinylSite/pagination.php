<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $valuePag=$_POST['valuePag'];
        $msg="";
        $code=200;
        
        $products=returnProductsPag($valuePag);
        $numPages=returnNumberPages();
        $arrayBack=([
            "products"=>$products,
            "numPages"=>$numPages
        ]);
        if($arrayBack){
           $msg=$arrayBack;
           $code=200;
        }
        else{
            $msg="Server error";
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