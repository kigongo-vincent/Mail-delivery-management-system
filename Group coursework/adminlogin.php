<?php
session_start();
include './connect.php';
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query_run = mysqli_query($conn, "select * from admin");
    $adminname = '';
    $adminpass = '';
    $login_id = '';
    while($row = mysqli_fetch_assoc($query_run)){
        $adminname = $row['username'];
        $adminpass = $row['password'];
        $login_id = $row['adminID'];
    }
    if($username == $adminname && password_verify($password, $adminpass)){
       
            $_SESSION['username'] =$username;
            $_SESSION['login-id'] = $login_id;
            header('Location: admindashboard.php');
    }
    else{
        header('Location: adminlogin.html');
    }
   
}

