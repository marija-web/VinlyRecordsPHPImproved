<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataArtist=$_POST['dataArtist'];
        $nameArtist=$_POST['nameArtist'];

        $msg="";
        $code=200;
        
        $updateArtist=updateArtist($dataArtist, $nameArtist);
        if($updateArtist){
           $artist=getAllFromTabel("artist");
           $msg=$artist;
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