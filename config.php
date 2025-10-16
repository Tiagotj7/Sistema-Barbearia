<?php
$host='sql202.infinityfree.com';$user='if0_40183884';$pass='kTDOZF73sRu3hmv';$db='if0_40183884_barbearia';
$con=mysqli_connect($host,$user,$pass,$db);
if(!$con)die('Erro:'.mysqli_connect_error());
mysqli_set_charset($con,'utf8mb4');
