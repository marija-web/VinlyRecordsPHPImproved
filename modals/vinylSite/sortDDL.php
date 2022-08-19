<?php
     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        include "../functions.php";
        $valueSort=$_POST['valueSort'];
        $msg="";
        $code=200;
        $asc="ASC";
        $desc="DESC";
        $tableName="name_products";
        $tablePrice="price_now";
        
        if($valueSort=="Album name A-Z"){
            $ascORdesc=$asc;
            $table=$tableName;
            $sortDDL=sortDDL($ascORdesc, $table);
        }

        if($valueSort=="Album name Z-A"){
            $ascORdesc=$desc;
            $table=$tableName;
            $sortDDL=sortDDL($ascORdesc, $table);
        }

        if($valueSort=="Low to High price"){
            $ascORdesc=$asc;
            $table=$tablePrice;
            $sortDDL=sortDDL($ascORdesc, $table);
        }

        if($valueSort=="High to Low price"){
            $ascORdesc=$desc;
            $table=$tablePrice;
            $sortDDL=sortDDL($ascORdesc, $table);
        }

        if($sortDDL){
           $msg=($sortDDL);
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