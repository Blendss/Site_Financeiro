<?php
include('conexao.php');

session_start();
echo "o id é: " . $_SESSION['id'];
echo '<br>';
echo "o nome é: " . $_SESSION['nome'];
$id = $_SESSION['id'];

$sql_code = "SELECT * FROM contas WHERE id = '$id'";
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
echo '<br>';
$quantidade = $sql_query->num_rows;
echo "a quantidade de linhas é: " . $quantidade;
echo '<br>';
$usuario = $sql_query->fetch_assoc();
echo $usuario['id'];
echo '<br>';
echo $usuario['email'];
echo '<br>';
echo $usuario['nome'];
echo '<br>';
echo $usuario['senha'];







?>





<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>