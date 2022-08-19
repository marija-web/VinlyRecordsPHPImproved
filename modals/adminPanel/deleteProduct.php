<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $dataProduct=$_POST['dataProduct'];
        $msg="";
        $code=200;
        
        $deleteProduct=delete("products", "id_products", $dataProduct);
        
        if($deleteProduct){
           $products=getProducts();
           $cat=getAllFromTabel("category");
           $arrayBack=([
                "products"=>$products,
                "cat"=>$cat
           ]);
           $msg=$arrayBack;
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