<?php
include './connect.php';
if(isset($_POST['submit'])){
    if($_FILES['upload']['name']){
        $file_tmp = $_FILES['upload']['tmp_name'];
        $target_dir = "upload/0.jpg";
        move_uploaded_file($file_tmp, $target_dir);
    
    }

$uname = $_POST['uname'];
$pass = $_POST['adminpass'];
$enc = password_hash($pass, PASSWORD_BCRYPT);
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$sql = "update admin set password = '$enc',username = '$uname', gender = '$gender', email = '$email', dob = '$dob'   where adminID = 0";
mysqli_query($conn, $sql);


}
header('Location: admindashboard.php'); 

