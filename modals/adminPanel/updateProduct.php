<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataProducts=$_POST['dataProducts'];
        $nameProducts=$_POST['nameProducts'];
        $catValue=$_POST['catValue'];
        $delivery=$_POST['delivery'];
        $description=$_POST['description'];
        $msg="";
        $code=200;
        $valid=true;
       
        if(empty($_FILES['filePicture'])){
            $name=$_POST['filePicture'];
        }
        else{
            $filePicture=$_FILES['filePicture'];
            $tmpName=$filePicture['tmp_name'];
            $type=$filePicture['type'];
            $name=$filePicture['name'];
            $name=time().$name;
            $src="../../assets/img/gallery/$name";
            $typeNew=explode("/", $type);
            $extension=$typeNew[1];

            if($extension!="png" && $extension!="jpg" && $extension!="jpeg"){
                $valid=false;
            }
        }
        if($valid && move_uploaded_file($tmpName, $src)){
            resizePicture();
            $updateProduct=updateProduct($dataProducts, $nameProducts, $catValue, $delivery, $name, $description);
        }
        
        if($updateProduct){
            if(!empty($_FILES['filePicture'])){
                $result=move_uploaded_file($tmpName, $src.$name);
            }
           $products=getProducts();
           $cat=getAllFromTabel("category");
           $arrayBack=([
                "products"=>$products,
                "cat"=>$cat,
                "msg"=>"You have you have successfully updated this row!"
           ]);
           $msg=$arrayBack;
           $code=200;
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