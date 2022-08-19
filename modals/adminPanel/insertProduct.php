<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $nameProduct=$_POST['nameProduct'];
        $priceProduct=$_POST['priceProduct'];
        $delivery=$_POST['delivery'];
        $catValue=$_POST['catValue'];
        $artistValue=$_POST['artistValue'];
        $filePicture=$_FILES['filePicture'];
        $tmpName=$filePicture['tmp_name'];
        $type=$filePicture['type'];
        $name=$filePicture['name'];
        $name=time().$name;
        $size=$filePicture['size'];
        $description=$_POST['description'];
        $src="../../assets/img/gallery/$name";
        $typeNew=explode("/", $type);
        $extension=$typeNew[1];
        $msg="";
        $code=200;
        $valid=true;

        if($extension!="png" && $extension!="jpg" && $extension!="jpeg"){
            $valid=false;
        }

        if($nameProduct=="" || $catValue=="0" || $artistValue=="0" || $description=="0"){
            $valid=false;     
        }

            if($valid && move_uploaded_file($tmpName, $src)){
            resizePicture();    
            $insertProduct=insertProduct($nameProduct, $priceProduct, $delivery, $catValue, $artistValue, $name, $description);
        }
        if($insertProduct){
                $msg="You have successfully inserted one row in table products!";
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