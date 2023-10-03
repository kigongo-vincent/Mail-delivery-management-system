<?php
include './connect.php';
if(isset($_POST['submit'])){
    $date = date('y:m:d');
    $reciever_name = $_POST['reciever-name'];
    $pobox = $_POST['po-box'];
    $contact = $_POST['contact'];
    mysqli_query($conn, "insert into mail(client_name, p_o_box, date_Added, contact) values('$reciever_name', '$pobox', '$date', '$contact')");
    header('Location: admindashboard.php');
}
