<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $idUser=$_POST['idUser'];
        $msg="";
        $code=200;
        $valid=true;
        $insertUser=insertUser($idUser);
        if($insertUser){
            for($i=0; $i<count($_POST)-1; $i++){
                $quantity=$_POST['cart'.$i]['quantity'];
                $idProducts=$_POST['cart'.$i]['id_products'];
                $insertToCart=insertToCart($insertUser, $quantity, $idProducts);
                if($insertToCart==false){
                    $code=500;
                }
                else{
                    $msg="Thank you for supporting us.";
                    $code=201;
                }
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