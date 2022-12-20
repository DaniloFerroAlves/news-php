<?php
error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);
$conexao = mysqli_connect('localhost', 'root', '', 'news');
mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao,'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_Set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');

if (mysqli_connect_errno()){
  echo 'Conexão com o MySQL falhou: ' . mysqli_connect_error();
}
?>