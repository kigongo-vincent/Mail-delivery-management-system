<?php 
include './connect.php';
$query_run = mysqli_query($conn, "select * from admin_inbox INNER JOIN staff on admin_inbox.staffID = staff.staffID order by msg_id desc");
$messages = [];
while($row = mysqli_fetch_assoc($query_run)){
array_push($messages, $row);
}
echo json_encode($messages);