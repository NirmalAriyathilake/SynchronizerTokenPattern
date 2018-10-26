<?php
    session_start();

    if(isset($_POST['sessionid'])){
        ob_end_clean(); // buffer clean

        generateToken($_POST['sessionid']);
    }
    
    if(isset($_POST['submit'])){
        ob_end_clean(); // buffer clean

        validate($_POST['username'],$_POST['password']);
    }

    if(isset($_POST['addstatussubmit'])){
        ob_end_clean(); // buffer clean

        validateStatus($_POST['token_csrf'],$_COOKIE['sessionCookie']);
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
    function validate($username,$password){
        /**
         * For demo ,
         * Username : user
         * Password : user
         */

        if($username == "user" && $password == "user"){
            $cookieName = "sessionCookie"; 
            
            generateToken($_COOKIE[$cookieName]);
            
            echo "<script> alert('Successfully Logged In') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        
        }else{
            echo "<script> alert('Login failed! Check username and password again !!!') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'index.php';</script>";
        }
    }

    //validate status
    function validateStatus($token,$cookie){
        if($token == $_SESSION[$cookie] && $cookie==session_id()){
            echo "<script> alert('Status successfully added') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        }else{
            echo "<script> alert('Status posting failed! CSRF token not matched !!!') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        }
    }

?>