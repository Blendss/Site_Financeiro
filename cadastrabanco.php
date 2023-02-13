<?php
include('conexao.php');
session_start();
$id = $_SESSION['id'];

if(isset($_POST['hidden'])){
	if(isset($_POST['bb']) || isset($_POST['brad']) || isset($_POST['sant']) || isset($_POST['caixa'])  || isset($_POST['itau'])  || isset($_POST['nuba'])  || $_POST['procure'] != 1000) {
		

		if(isset($_POST['bb']) != 0) {
		$sql_code = "INSERT INTO `usuariobancos`(`id`, `cod`) VALUES ('".$id."','".$_POST['bb']."')";
		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		}
		if(isset($_POST['brad']) != 0) {
		$sql_code = "INSERT INTO `usuariobancos`(`id`, `cod`) VALUES ('".$id."','".$_POST['brad']."')";
		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		}
		if(isset($_POST['sant']) != 0) {
		$sql_code = "INSERT INTO `usuariobancos`(`id`, `cod`) VALUES ('".$id."','".$_POST['sant']."')";
		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		}
		if(isset($_POST['caixa']) != 0) {
		$sql_code = "INSERT INTO `usuariobancos`(`id`, `cod`) VALUES ('".$id."','".$_POST['caixa']."')";
		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		}
		if(isset($_POST['itau']) != 0) {
		$sql_code = "INSERT INTO `usuariobancos`(`id`, `cod`) VALUES ('".$id."','".$_POST['itau']."')";
		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		}
		if(isset($_POST['nuba']) != 0) {
		$sql_code = "INSERT INTO `usuariobancos`(`id`, `cod`) VALUES ('".$id."','".$_POST['nuba']."')";
		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		}
		if(isset($_POST['procure'])) {
			if(($_POST['procure']) != 1000) {
			$sql_code = "INSERT INTO `usuariobancos`(`id`, `cod`) VALUES ('".$id."','".$_POST['procure']."')";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
			}
		}
		header("Location: extrato.php");
	}else{
		echo "Selecione ao menos um banco!";
	}
	
}



?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<!-- CSS only -->
<link rel="stylesheet" href="cadastro.css" />
</head>
<body>
<div>
    <h1>Adicionar conta bancaria</h1>
</div>
<div align="center">
<form action="" method="POST">
		<br>
	<select name="procure" class="select-bancos" aria-label="Default select example">
  <option value="1000" selected>Procure seu banco</option>
	<?php 
		$sql_code = "SELECT * FROM `bancos`";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		while($dados = $sql_query->fetch_array()){
			echo "<option value='".$dados['cod']."'>".$dados['banco']."</option>";
		}
		?>
</select>
<br>
		<table border="0">
		<tr>
        <td><input class="check" type="checkbox" name="bb" placeholder="" value="001"/></td>
		<td><img src="img/bb.gif"/> </td>
        <td><label class="label-bancos">Banco do Brasil</label></td>
		</tr>
		<tr>
	    <td><input class="check" type="checkbox" name="brad" placeholder="" value="237"/></td>
		<td><img src="img/brad.gif"/> </td>
        <td><label class="label-bancos">Banco Bradesco</label></td>
		</tr>
		<tr>
        <td><input class="check" type="checkbox" name="sant" placeholder="" value="033"/></td>
		<td><img src="img/sant.gif"/> </td>
        <td><label class="label-bancos">Banco Santander</label></td>
		</tr>
		<tr>
	    <td><input class="check" type="checkbox" name="caixa" placeholder="" value="104"/></td>
		<td><img src="img/cef.gif"/> </td>
        <td><label class="label-bancos">Caixa Economica Federal</label></td>
		</tr>
		<tr>
        <td><input class="check" type="checkbox" name="itau" placeholder="" value="341"/></td>
		<td><img src="img/itau.gif"/> </td>
        <td><label class="label-bancos">Banco Itau</label></td>
		</tr>
		<tr>
	    <td><input class="check" type="checkbox" name="nuba" placeholder="" value="260"/></td>
		<td><img src="img/nub.gif"/> </td>
        <td><label class="label-bancos">Nubank</label></td>
		</tr>
		</table>
		<br><br>
		<input name="hidden" type="hidden" value="hidden"/>
		<button class="button-bancos" type="submit">Enviar</button>
</form>
	</div>
</body>
</html>