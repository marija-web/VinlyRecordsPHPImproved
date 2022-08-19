<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataPrice=$_POST['dataPrice'];
        $priceOld=$_POST['priceOld'];
        $priceNow=$_POST['priceNow'];

        $msg="";
        $code=200;
        
        $updatePrice=updatePrice($dataPrice, $priceOld, $priceNow);
        if($updatePrice){
           $msg="You have successfully updated this row!";
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