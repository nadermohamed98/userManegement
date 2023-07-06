<?php 
include_once "connection.php";
include_once "functions.php";
session_start();
error_reporting(0);

if(isset($_POST['login'])){
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['pass'] = md5($_POST['pass']);

    $validator = login();
    if(count($validator['errors']) == 0){
        $url = "../Dashboard/home.php";
        header("location:$url");
    }else{
        foreach($validator['errors'] as $msg){
            $params .= "&msg[]=" . $msg ;
        }
        $url1 = "login.php?".$params;
        header("refresh:1;url=$url1");
    }
}

if(isset($_POST['submitRigist'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $role_id = $_POST['role_id'];
    $validator = validate($_POST);
    if(count($validator) == 0){
        if(checkEmailUnique($email)){        
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            
            $insertNewUser = "INSERT INTO users (`name`,`email`,`password`,`role_id`) VALUES('$name','$email','$pass','$role_id')";
            if(mysqli_query($con,$insertNewUser)){
                $url = "../Dashboard/home.php";
                header("refresh:1;url=$url");
            }else{
                $url = "../auth/regist.php";
                header("refresh:1;url=$url");
            }
        }else{
            $url1 = "regist.php?msg[]=email allready Exists";
            header("refresh:1;url=$url1");
        }
    }else{
        foreach($validator as $msg){
            $params .= "&msg[]=" . $msg ;
        }
        $url1 = "regist.php?".$params;
        header("refresh:1;url=$url1");
    }
}

if(!empty($_SESSION['user']) && !empty($_SESSION['pass'])){
    $userDateQuery = "SELECT * FROM users WHERE `email`='$_SESSION[user]' AND `password`='$_SESSION[pass]' AND deleted_at IS NULL";
    $userDate = mysqli_query($con,$userDateQuery);
    if(mysqli_num_rows($userDate) > 0){
        $userDateFetch = mysqli_fetch_array($userDate);
        $Logged_id = $userDateFetch['id'];
        $Logged_name = $userDateFetch['name'];
        $Logged_email = $userDateFetch['email'];
        $Logged_pass = $userDateFetch['password'];
        $Logged_img = $userDateFetch['img'] ? $userDateFetch['img'] : "user.jpg" ;
        $Logged_role = $userDateFetch['role_id'];
    }else{
        if(basename($_SERVER['PHP_SELF']) != "login.php" && basename($_SERVER['PHP_SELF']) != "regist.php")
            header("location:../auth/login.php");
    }
}else{
    if(basename($_SERVER['PHP_SELF']) != "login.php" && basename($_SERVER['PHP_SELF']) != "regist.php")
        header("location:../auth/login.php");
}
?>