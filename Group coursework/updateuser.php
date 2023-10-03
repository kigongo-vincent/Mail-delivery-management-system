<?php
session_start();
$staff = $_SESSION['staffID'];
include './connect.php';
/* if(isset($_POST['submit'])){ */
    if($_FILES['upload']['name']){
        $file_tmp = $_FILES['upload']['tmp_name'];
        $target_dir = "upload/$staff.jpg";
        move_uploaded_file($file_tmp, $target_dir);
    
    }

$uname = $_POST['staffname'];
$pass = $_POST['staffpass'];
$enc = password_hash($pass, PASSWORD_BCRYPT);
$gender = $_POST['staffgender'];
$dob = $_POST['staffdob'];
$email = $_POST['staffemail'];
$sql = "update staff set password = '$enc',username = '$uname', gender = '$gender', email = '$email', dob = '$dob'   where staffID = '$staff'";
mysqli_query($conn, $sql);



header('Location: userdashboard.php'); 

