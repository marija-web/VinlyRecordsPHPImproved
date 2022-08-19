<?php
    session_start();
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include_once "../functions.php";
        $emailL=$_POST['emailL'];
        $passsL=$_POST['passL'];
        $msg="";
        $code=200;
        $validLo=true;

        //regularni 
        $eMailRegexL='/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$/';
        $passRegexL='/^.{6,30}$/';

        //funkcija za proveru
        function formCheckServerL($valueS, $regexS, $textS){
            if($valueS==""){
                $validLo=false;
                $msg="You need to fill out this field.";
            }
            else{
                if(!preg_match($regexS, $valueS)){
                    $validLo=false;
                    $msg=$textS;
                }
                else{
                    $msg="";
                }
            }
        }
        //email
        formCheckServerL($emailL, $eMailRegexL, "Please enter a valid email address.");
    
        //message
        formCheckServerL($passsL, $passRegexL, "Password not in a good format - it must have at least 6 charachters.");

        if($validLo){
            $pass=md5($passsL);
            $user=loginUser($emailL, $pass);
            if($user){
               try{
                    $date=date("d-m-Y H:i:s");
                    $file=fopen("../../data/logedUsers.txt", "a");
                    $content=$emailL."__".$date."\n";
                    if($file){
                        fwrite($file, $content);
                        fclose($file);
                    }
                    $_SESSION['user']=$user; 
                    $_SESSION['idRole']=$user->id_roles; 
                    $code=200;
                    $msg="Welcome - you have successfully logged in.";
               } 
                catch(PDOException $ex){
                    $code=500;
                    $msg="Server error.";
                }
            }
            else{
                $msg="Something is not correct-check your email or password.";
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