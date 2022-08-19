<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataArtist=$_POST['dataArtist'];
        $msg="";
        $code=200;
        
        $deleteArtist=delete("artist", "id_artist", $dataArtist);
        
        if($deleteArtist){
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