<?php
include './connect.php';
$content = trim(file_get_contents('php://input'));
$array = json_decode($content, true);
$id = $array['mid'];
mysqli_query($conn, "delete from mail where mailID = $id");
echo json_encode('mail has been deleted');

