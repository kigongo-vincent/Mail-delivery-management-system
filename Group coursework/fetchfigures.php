<?php
include './connect.php';
$query = mysqli_query($conn, "select DISTINCT username, COUNT(*) as freq from (
    SELECT username from staff INNER join mail  on staff.staffID = mail.staffID
    ) sub   GROUP BY username");
$userperformance = [];
$usernames = [];
while($row = mysqli_fetch_assoc($query)){
    array_push($userperformance, $row['freq']);
    array_push($usernames, $row['username']);
}    
$joint = [
    'names' => $usernames,
    'numbers' => $userperformance
];
echo json_encode($joint);