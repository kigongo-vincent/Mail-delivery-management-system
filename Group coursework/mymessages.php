<?php 
session_start();
$staff = $_SESSION['staffID'];
include './connect.php';
$query_run = mysqli_query($conn, "select * from admin_inbox inner join admin on admin_inbox.admnID = admin.adminID where staffID = '$staff' order by msg_id desc ");
$messages = [];
$adminname ='';
$adminmail = '';
while($row = mysqli_fetch_assoc($query_run)){
array_push($messages, $row);
$adminname = $row['username'];
$adminmail = $row['email'];

}
$joint = [
    $messages,
    $adminname,
    $adminmail
];
echo json_encode($joint);