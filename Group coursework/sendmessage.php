<?php
include 'connect.php';
session_start();
$content = trim(file_get_contents('php://input'));
$array = json_decode($content, true);
$sent = $array['sent'];
$date = date('y:m:d');
$staff = $_SESSION['staffID'];
mysqli_query($conn, "insert admin_inbox(body, date, staffID) values('$sent', '$date','$staff') ");
echo json_encode('Message has been sent');