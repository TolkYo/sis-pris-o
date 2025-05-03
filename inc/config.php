<?php

set_time_limit(0);
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '200M');

$host = "127.0.0.1";
$usuario = "root";
$senha = "dinobel2";
$banco = "bd_prisao";


$conn = new mysqli($host, $usuario, $senha, $banco) or die("Falha na conexão: " . $conn->connect_error);
$nomeAPP = 'Teste';