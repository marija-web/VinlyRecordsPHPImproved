<?php
    require_once(__DIR__."/../config/connection.php");
    define("OFFSET", 4);//4 proizvoda 

    function sendMessage($msg, $userId){
        global $conn;
        
        try{
            $query="INSERT INTO msguser(id_msg, message_user, id_user) VALUES(NULL, :msg, $userId)";
            $send=$conn->prepare($query);
            $send->bindParam(":msg", $msg);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function getProducts(){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.id_cat=c.id_cat INNER JOIN artist a ON p.id_artist=a.id_artist INNER JOIN price r ON p.id_products=r.id_products ORDER BY p.id_products";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function getAllFromTabel($nameTabel){
        global $conn;

        try{
            $query="SELECT * FROM $nameTabel";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function filterCat($id){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.id_cat=c.id_cat JOIN artist a ON p.id_artist=a.id_artist INNER JOIN price r ON p.id_products=r.id_products WHERE c.id_cat=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $send->execute();
            $result=$send->fetchAll();
            return $result;

        }
        catch(PDOException $e){
            $message="Server error";
        }
    
    }

    function registerUser($firstNameR, $lastNameR, $emailR, $passR){
        global $conn;

        try{
            $pass=md5($passR);
            $query="INSERT INTO user(id_user,name_user, lastname_user, email_user, password_user, id_roles) VALUES(NULL,:firstNameR, :lastNameR, :emailR, :pass, 2)";
            $send=$conn->prepare($query);
            $send->bindParam(":firstNameR", $firstNameR);
            $send->bindParam(":lastNameR", $lastNameR);
            $send->bindParam(":emailR", $emailR);
            $send->bindParam(":pass", $pass);
 
            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function loginUser($emailL, $pass){
        global $conn;

        try{
            $query="SELECT * FROM user u JOIN roles r ON u.id_roles=r.id_roles WHERE u.email_user=:emailL AND u.password_user=:pass";
            $send=$conn->prepare($query);
            $send->bindParam(":emailL", $emailL);
            $send->bindParam(":pass", $pass);

            $send->execute();
            $result=$send->fetch();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function search($valueS){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.id_cat=c.id_cat INNER JOIN artist a ON p.id_artist=a.id_artist INNER JOIN price r ON p.id_products=r.id_products WHERE p.name_products LIKE '%$valueS%' OR a.name_artist LIKE '%$valueS%'";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function surveyQ(){
        global $conn;

        try{
            $query="SELECT * FROM survey WHERE activ=1";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function surveyA(){
        global $conn;

        try{
            $query="SELECT * FROM survey s INNER JOIN answersurvey a ON s.idSurvey=a.idSurvey";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function alreadyAnswered($id, $user){
        global $conn;

        try{
            $query="SELECT * FROM votesurvey v INNER JOIN answersurvey a ON v.id_answer=a.idAnswer WHERE v.id_user=:user AND a.idSurvey=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":user", $user);
            $send->bindParam(":id", $id);

            $send->execute();
            $result=$send->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    
    function sendSurvey($value, $user){
        global $conn;

        try{
            $query="INSERT INTO votesurvey (id_user, id_answer) VALUES(:id, :valueA)";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $user);
            $send->bindParam(":valueA", $value);

            $result= $send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function returnProductsPag($limit = 0){
        global $conn;

        try{
        $query = "SELECT * FROM products p INNER JOIN category c ON p.id_cat=c.id_cat INNER JOIN artist a ON p.id_artist=a.id_artist INNER JOIN price r ON p.id_products=r.id_products LIMIT :limit, :offset";

        $send = $conn->prepare($query);

        $limit = ($limit) * OFFSET;
        $send->bindParam(":limit", $limit, PDO::PARAM_INT); 

        $offset = OFFSET;
        $send->bindParam(":offset", $offset, PDO::PARAM_INT);

        $send->execute(); 

        $result = $send->fetchAll();

        return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }

    }

    function returnNumberProducts(){
        global $conn;
        $query = "SELECT COUNT(*) AS num FROM products";
        $result = $conn->query($query)->fetch();

        return $result;
    }

    function returnNumberPages(){
        $numberP = returnNumberProducts();
        $number= ceil($numberP->num / OFFSET);

        return $number;
    }

    function messagesReturn(){
        global $conn;

        try{
            $query="SELECT * FROM msguser m INNER JOIN user u ON m.id_user=u.id_user";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function deleteMessage($idMessage){
        global $conn;
        
        try{
            $query="DELETE FROM msguser WHERE id_msg=:idMessage";
            $send=$conn->prepare($query);
            $send->bindParam(":idMessage", $idMessage);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function getAdmin(){
        global $conn;

        try{
            $query="SELECT * FROM user WHERE id_roles=1";
            $result=$conn->query($query)->fetch();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateAdmin($nameAdmin, $lastNameAdmin, $emailAdmin){
        global $conn;

        try{
            $query="UPDATE user SET name_user = :nameAdmin, lastname_user = :lastNameAdmin, email_user = :emailAdmin WHERE id_roles=1";
            $send=$conn->prepare($query);
            $send->bindParam(":nameAdmin", $nameAdmin);
            $send->bindParam(":lastNameAdmin", $lastNameAdmin);
            $send->bindParam(":emailAdmin", $emailAdmin);
            
            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function deleteMenu($dataMenu){
        global $conn;
        
        try{
            $query="DELETE FROM menu WHERE id_menu=:dataMenu";
            $send=$conn->prepare($query);
            $send->bindParam(":dataMenu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateMenu($dataMenu, $nameMenu, $hrefMenu, $showMenu, $priorityMenu){
        global $conn;

        try{
            $query="UPDATE menu SET name_menu = :nameMenu, href_menu = :hrefMenu, show_menu = :showMenu, priority_menu = :priorityMenu WHERE id_menu=:dataMenu";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":hrefMenu", $hrefMenu);
            $send->bindParam(":showMenu", $showMenu);
            $send->bindParam(":priorityMenu", $priorityMenu);
            $send->bindParam(":dataMenu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertMenu($nameMenu, $hrefMenu, $showMenu, $priorityMenu){
        global $conn;
        
        try{
            $query="INSERT INTO menu(id_menu, name_menu, href_menu, show_menu, priority_menu) VALUES(NULL, :nameMenu, :hrefMenu, :showMenu, :priorityMenu)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":hrefMenu", $hrefMenu);
            $send->bindParam(":showMenu", $showMenu);
            $send->bindParam(":priorityMenu", $priorityMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function delete($table, $column, $id){
        global $conn;
        
        try{
            $query="DELETE FROM $table WHERE $column=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

    function updateCategory($dataCategory, $nameCategory){
        global $conn;

        try{
            $query="UPDATE category SET name_cat = :nameCategory WHERE id_cat=:dataCategory";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);
            $send->bindParam(":dataCategory", $dataCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertCategory($nameCategory){
        global $conn;
        
        try{
            $query="INSERT INTO category(id_cat, name_cat) VALUES(NULL, :nameCategory)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateArtist($dataArtist, $nameArtist){
        global $conn;

        try{
            $query="UPDATE artist SET name_artist = :nameArtist WHERE id_artist=:dataArtist";
            $send=$conn->prepare($query);
            $send->bindParam(":nameArtist", $nameArtist);
            $send->bindParam(":dataArtist", $dataArtist);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertArtist($nameArtist){
        global $conn;
        
        try{
            $query="INSERT INTO artist(id_artist, name_artist) VALUES(NULL, :nameArtist)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameArtist", $nameArtist);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function priceProduct(){
        global $conn;

        try{
            $query="SELECT * FROM price p INNER JOIN products pr ON p.id_products=pr.id_products";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updatePrice($dataPrice, $priceOld, $priceNow){
        global $conn;

        try{
            $query="UPDATE price SET price_old = :priceOld, price_now = :priceNow WHERE id_price=:dataPrice";
            $send=$conn->prepare($query);
            $send->bindParam(":priceOld", $priceOld);
            $send->bindParam(":priceNow", $priceNow);
            $send->bindParam(":dataPrice", $dataPrice);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function usersAll(){
        global $conn;

        try{
            $query="SELECT * FROM user u INNER JOIN roles r ON u.id_roles=r.id_roles";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateRole($dataUser, $role){
        global $conn;

        try{
            $query="UPDATE user SET id_roles = :roleId WHERE id_user=:dataUser";
            $send=$conn->prepare($query);
            $send->bindParam(":roleId", $role);
            $send->bindParam(":dataUser", $dataUser);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function updateRoleUser($dataRole, $nameRole){
        global $conn;

        try{
            $query="UPDATE roles SET role = :nameRole WHERE id_roles=:dataRole";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);
            $send->bindParam(":dataRole", $dataRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function insertRole($nameRole){
        global $conn;
        
        try{
            $query="INSERT INTO roles(id_roles, role) VALUES(NULL, :nameRole)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateProduct($dataProducts, $nameProducts, $catValue, $delivery, $name, $description){
        global $conn;

        try{
            $query="UPDATE products SET name_products = :nameProducts, picture_src=:name, id_cat = :catValue, delivery = :delivery, description = :description WHERE id_products=:dataProducts";
            $send=$conn->prepare($query);
            $send->bindParam(":nameProducts", $nameProducts);
            $send->bindParam(":name", $name);
            $send->bindParam(":catValue", $catValue);
            $send->bindParam(":delivery", $delivery);
            $send->bindParam(":dataProducts", $dataProducts);
            $send->bindParam(":description", $description);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message=$e->getMessage();
            echo $e->getMessage();
        } 
    }

    function insertProduct($nameProduct, $priceProduct, $delivery, $catValue, $artistValue, $name, $description){
        global $conn;
        
        try{
            $query="INSERT INTO products(id_products, name_products, picture_src, id_cat, delivery, id_artist, description) VALUES(NULL, :nameProduct, :name, :catValue, :delivery, :artistValue, :description)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameProduct", $nameProduct);
            $send->bindParam(":name", $name);
            $send->bindParam(":catValue", $catValue);
            $send->bindParam(":delivery", $delivery);
            $send->bindParam(":artistValue", $artistValue);
            $send->bindParam(":description", $description);

            $result=$send->execute();
            if($result){
                $lastID=$conn->lastInsertId();
                $queryPrice="INSERT INTO price(price_now, id_products) VALUES(:priceProduct, :lastID)";
                $sendPrice=$conn->prepare($queryPrice);
                $sendPrice->bindParam(":priceProduct", $priceProduct);
                $sendPrice->bindParam(":lastID", $lastID);
                $result=$sendPrice->execute();
            }
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
            echo $e->getMessage();
        }
    }

    function insertUser($idUser){
        global $conn;
        
        try{
            $query="INSERT INTO shoppingdone(id_cart, id_user) VALUES(NULL, :idUser)";
            $send=$conn->prepare($query);
            $send->bindParam(":idUser", $idUser);

            $result=$send->execute();
            if($result){
                $lastId=$conn->lastInsertId();
                return $lastId;
            }
            else{
                return $result;
            }
           
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function insertToCart($insertUser, $quantity, $idProducts){
        global $conn;
        
        try{
            $query="INSERT INTO items_shop(id_item, id_cart, id_product, quantity) VALUES(NULL, :insertUser, :idProducts, :quantity)";
            $send=$conn->prepare($query);
            $send->bindParam(":insertUser", $insertUser);
            $send->bindParam(":idProducts", $idProducts);
            $send->bindParam(":quantity", $quantity);


            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function catchAnswer($id){
        global $conn;

        try{
            $query="SELECT a.* FROM survey s INNER JOIN answersurvey a ON s.idSurvey=a.idSurvey WHERE s.idSurvey=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $result=$send->execute();
            $result=$send->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function countAll($id){
        global $conn;

        try{
            $idS=catchSurvey($id);
            $idS=$idS->idSurvey;
            $countAllS=countAllS($idS);
            $countAlls=$countAllS->surv;
            $query="SELECT ROUND((SELECT COUNT(v.id_answer) FROM votesurvey v INNER JOIN 
            answersurvey a ON v.id_answer=a.idAnswer WHERE v.id_answer=:id)/:countAlls*100)
            as numb";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $send->bindParam(":countAlls", $countAlls);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;

        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

    function catchSurvey($id){
        global $conn;

        try{
            $query="SELECT s.idSurvey FROM survey s INNER JOIN answersurvey a ON s.idSurvey=a.idSurvey WHERE a.idAnswer=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

    function countAllS($idS){
        global $conn;

        try{
            $query="SELECT COUNT(v.id_answer) as surv FROM survey s INNER JOIN answersurvey a ON s.idSurvey=a.idSurvey INNER JOIN votesurvey v ON v.id_answer=a.idAnswer WHERE s.idSurvey=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $idS);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

    function activeNoActive($value, $check){
        global $conn;

        try{
            $query="UPDATE survey SET activ = :check WHERE idSurvey=:value";
            $send=$conn->prepare($query);
            $send->bindParam(":check", $check);
            $send->bindParam(":value", $value);

            $result=$send->execute();
            if($check==1){
                $result="Survey is activated.";
            }
            else{
                $result="Survey is deactivated.";
            }
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function returnProduct($id){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.id_cat=c.id_cat INNER JOIN artist a ON p.id_artist=a.id_artist INNER JOIN price r ON p.id_products=r.id_products WHERE p.id_products=?";
            $prepare=$conn->prepare($query);
            $prepare->execute([$id]);
            $result=$prepare->fetch();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function sortDDL($ascORdesc, $table){
        global $conn;

        try{
            $query="SELECT * FROM products p INNER JOIN category c ON p.id_cat=c.id_cat INNER JOIN artist a ON p.id_artist=a.id_artist INNER JOIN price r ON p.id_products=r.id_products ORDER BY $table $ascORdesc";
            $send=$conn->query($query);
            $result=$send->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function getFromFile($nameFile){
        $file=file("data/".$nameFile);
        return $file;
    }

    function precentagePages(){

        $howMuch=[];
        $all=0;
        $mainPage=0;
        $shop=0;
        $contact=0;
        $register=0;
        $login=0;
        $logOut=0;
        $adminPanel=0;
        
        try{
            $file=file("data/log.txt");
            if(count($file)){
                foreach($file as $f){
                $ifs=explode("__",$f);
                $url=explode(".php",$ifs[0]);
                $url[1]=isset($url[1]) ? $url[1] : 0;
                $page=explode("&", $url[1]);
                    switch($page[0]){
                            case "?page=mainPage":
                                $mainPage++;
                                $all++;
                            break;
                            case "?page=shop":
                                $shop++;
                                $all++;
                            break;
                            case "?page=contact":
                                $contact++;
                                $all++;
                            break;
                            case "?page=register":
                                $register++;
                                $all++;
                            break;
                            case "?page=login":
                                $login++;
                                $all++;
                            break;
                            case "?page=logOut":
                                $logOut++;
                                $all++;
                            break;
                            case "?page=adminPanel":
                                $adminPanel++;
                                $all++;
                            break;
                        }
                }

                if($all>0){
                    $howMuch[]=round($mainPage*100/$all,2);
                    $howMuch[]=round($shop*100/$all,2);
                    $howMuch[]=round($contact*100/$all,2);
                    $howMuch[]=round($register*100/$all,2);
                    $howMuch[]=round($login*100/$all,2);
                    $howMuch[]=round($logOut*100/$all,2);
                    $howMuch[]=round($adminPanel*100/$all,2);
                    
                }
                return $howMuch;
            }
           
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function pages24(){

        $array=[];
        $mainPage=0;
        $shop=0;
        $contact=0;
        $register=0;
        $login=0;
        $logOut=0;
        $adminPanel=0;
        $dayAgo=strtotime("1 day ago");
        
        try{
            $file=file("data/log.txt");
            if(count($file)){
                foreach($file as $f){
                $ifs=explode("__",$f);
                $url=explode(".php",$ifs[0]);
                $url[1]=isset($url[1]) ? $url[1] : 0;
                $page=explode("&", $url[1]);
                @$time=strtotime($ifs[2]);
                if($time>=$dayAgo){
                    switch($page[0]){
                            case "?page=mainPage":
                                $mainPage++;
                            break;
                            case "?page=shop":
                                $shop++;
                            break;
                            case "?page=contact":
                                $contact++;
                            break;
                            case "?page=register":
                                $register++;
                            break;
                            case "?page=login":
                                $login++;
                            break;
                            case "?page=logOut":
                                $logOut++;
                            break;
                            case "?page=adminPanel":
                                $adminPanel++;
                            break;
                        }
                    }
                }
                $array=[$mainPage, $shop, $contact, $register, $login, $logOut, $adminPanel];
            
                return $array;
            }
           
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function countUsers(){
        $date1=date("d-m-Y");
        $countUser=0;

            $file=file("data/logedUsers.txt");
            foreach($file as $index=>$value){
                list($email, $date2)=explode("__", $value);
                $date2=explode(" ", $date2);
                $date2=$date2[0];
                if($date1==$date2){
                    $countUser++;
                }
            }
           return $countUser;
        
    }

    function resizePicture(){
        $filePicture=$_FILES['filePicture'];
        $type=$filePicture['type'];
        $name=$filePicture['name'];
        $name=time().$name;
        $src="../../assets/img/gallery/$name";
        $typeNew=explode("/", $type);
        $extension=$typeNew[1];
        list($width, $height)=getimagesize($src);
        $newWidth=200;
        $newHeight=$height*$newWidth/$width;

        if($extension=="png"){
            $uploadedSlika=imagecreatefrompng($src);
            $canvas=imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($canvas, $uploadedSlika, 0,0, 0,0, $newWidth, $newHeight, $width, $height);
            imagepng($canvas, "../../assets/img/gallery/smallGallery/Small".$name);
        }

        if($extension=="jpg"){
            $uploadedSlika=imagecreatefromjpeg($src);
            $canvas=imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($canvas, $uploadedSlika, 0,0, 0,0, $newWidth, $newHeight, $width, $height);
            imagejpeg($canvas, "../../assets/img/gallery/smallGallery/Small".$name);
        }

        if($extension=="jpeg"){
            $uploadedSlika=imagecreatefromjpeg($src);
            $canvas=imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($canvas, $uploadedSlika, 0,0, 0,0, $newWidth, $newHeight, $width, $height);
            imagejpeg($canvas, "../../assets/img/gallery/smallGallery/Small".$name);
        }
    }
    
?>