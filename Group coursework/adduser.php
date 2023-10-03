<?php
include './connect.php';
if(isset($_POST['submit'])){
    $staffname = $_POST['user-name'];
    $staffemail = $_POST['user-email'];
    $password = '0000';
    $enc = password_hash($password, PASSWORD_BCRYPT);
    mysqli_query($conn,"insert into staff(username,email,password) values('$staffname', '$staffemail','$enc')");
    header('Location: admindashboard.php');
}
