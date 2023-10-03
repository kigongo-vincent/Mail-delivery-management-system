<?php
include './connect.php';
$content = trim(file_get_contents('php://input'));
$array = json_decode($content, true);
$item ="%" . $array['search'] . "%";
$query = mysqli_query($conn, "select * from 
(
select * from mail WHERE client_name like '$item') sub left join staff  on sub.staffID = staff.staffID GROUP BY mailID");
$result = [];
while($row = mysqli_fetch_assoc($query)){
    array_push($result, $row);
}
echo json_encode($result);