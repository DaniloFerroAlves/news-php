<?php
session_start();
if (strlen($_SESSION['login']) == 0){
   header('Location: index.php');
   exit;
}
include('../includes/config.php');
?>