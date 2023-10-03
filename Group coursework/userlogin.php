<?php
session_start();
include "./connect.php";
if(isset($_POST['submit'])){
    $username = $_POST['username'];
$password = $_POST['password'];
mysqli_query($conn, 'select * from staff');
$user=mysqli_query($conn, "select * from staff where username = '$username'");
$staffname = '';
$staffpassword ='';
$staffid = '';
while($row = mysqli_fetch_assoc($user)){
    $staffname = $row['username'];
    $staffpassword = $row['password'];
    $staffid = $row['staffID'];
}
if($username = $staffname && password_verify($password,$staffpassword )){
    $_SESSION['staffID'] = $staffid;
    header('Location: userdashboard.php');
}
else{
    header('Location: userlogin.html');
}

}

