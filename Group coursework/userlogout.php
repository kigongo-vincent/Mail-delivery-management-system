<?php
session_start();
unset($_SESSION['staffID']);
header('Location: index.html');