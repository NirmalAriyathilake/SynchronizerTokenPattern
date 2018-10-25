<?php
    session_start();


    if(isset($_POST['sessionid'])){
        generateToken($_POST['sessionid']);
    }

    if(isset($_POST['submit'])){
        ob_end_clean(); // buffer clean

        validate($_POST['username'],$_POST['password'],$_POST['token_csrf'],$_COOKIE['sessionCookie']);
    }

    if(isset($_POST['addcommentsubmit'])){
        ob_end_clean(); // buffer clean

        validateComment($_POST['token_csrf'],$_COOKIE['sessionCookie']);
    }

    //generate csrf token
    function generateToken($sessionCookie){
        if(empty($_SESSION['random_key'])){
            $_SESSION['random_key'] = bin2hex(random_bytes(32));
        }

        $token = hash_hmac('sha256',$sessionCookie,$_SESSION['random_key']);
        
        $sessionID = session_id();
        $_SESSION[$sessionID] = $token;

        ob_start(); // store in buffer
        echo $token;
    }

    //validate cookie
    function validate($username,$password,$token,$cookie){
        /**
         * For demo ,
         * Username : user
         * Password : user
         */

        if($username == "user" && $password == "user"){
            if($token == $_SESSION[$cookie] && $cookie==session_id()){
            
                echo "<script> alert('Successfully Logged In') </script>";
                echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
            }else{
                echo "<script> alert('Login failed! CSRF token not matched !!!') </script>";
                echo "<script type=\"text/javascript\"> window.location.href = 'index.php';</script>";
            }
        }else{
            echo "<script> alert('Login failed! Check username and password again !!!') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'index.php';</script>";
        }
    }

    //validate comment
    function validateComment($token,$cookie){
        if($token == $_SESSION[$cookie] && $cookie==session_id()){
            echo "<script> alert('Status successfully added') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        }else{
            echo "<script> alert('Status posting failed! CSRF token not matched !!!') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        }
    }

?>