<?php
include('includes/logout.php');
$_SESSION['login'] = "";
session_unset();
session_destroy();
header('Location: index.php');
?>