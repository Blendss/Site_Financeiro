<?php
//Modulo de Conexao com Banco de Dados
//Para conexao sao necessarias as seguintes variaveis
//nessa ordem
$hostname = "localhost";
$bancodedados = "aplicativo";
$usuario = "root";
$senha = "";

//cria um Objeto
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    echo "Falha ao Conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;}

else { 
 //  echo "Conexao OK";
}
	
?>
