<?php
include './connect.php';
session_start();
$id = $_SESSION['staffID'];
$query = mysqli_query($conn, "select * from staff where staffID = '$id'");
$name = '';
$date = '';
$email = '';
$gender= '';
while($row = mysqli_fetch_assoc($query)){
    $name = $row['username'];
    $date = $row['dob'];
    $email = $row['email'];
    $gender = $row['gender'];

}
$joint =[
$name, $date, $email, $gender
];
echo json_encode($joint);
/* header('Location: userdashboard.php'); */
