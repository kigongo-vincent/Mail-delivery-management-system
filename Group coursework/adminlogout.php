<?php 
session_start();
unset($_SESSION['login-id']);
header('Location: index.html');