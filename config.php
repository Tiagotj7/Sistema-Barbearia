<?php
$host='localhost:3307';$user='root';$pass='';$db='if0_40183884_barbearia';
$con=mysqli_connect($host,$user,$pass,$db);
if(!$con)die('Erro:'.mysqli_connect_error());
mysqli_set_charset($con,'utf8mb4');
