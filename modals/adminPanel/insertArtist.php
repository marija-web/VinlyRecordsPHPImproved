<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $nameArtist=$_POST['nameArtist'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameArtist==""){
            $valid=false;
        }

        if($valid){
            $insertArtist=insertArtist($nameArtist);
        }

        if($insertArtist){
           $msg="You have successfully inserted one row in table artist!";
           $code=201;
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