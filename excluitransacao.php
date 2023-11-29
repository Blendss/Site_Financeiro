<?php
include('conexao.php');
session_start();
$id = $_SESSION['id'];
$registro = $_GET['registro'];



if(isset($_POST['flag'])){
	if($_POST['pagrec'] == 'recebido'){$TEXTO = "credito";} else{$TEXTO = "debito";}
	$sql_code = "DELETE FROM `extrato` WHERE registro = ". $registro ."";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
	header("Location: extrato.php");
}

$sql_code = "SELECT * FROM `extrato` WHERE registro =" . $registro . ";";

$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
$info = $sql_query->fetch_assoc();

?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Untitled Document</title>
   <link rel="stylesheet" href="cadastro.css" />
   <script src="index.js"></script>
</head>

<body>
	<div align="center">
	<h1>Excluir Transação?</h1>
	</div>
	<div align="center">
	<form action="" method="POST">
        <input type="text" name="nome" placeholder="Nome da pessoa/instituiçao" <?php echo 'Value = "' . $info['nome'] . '"'; ?> readonly/>
        <input type="number"  name="valor" placeholder="Valor pago/recebido" <?php echo 'Value = "' . $info['valor'] . '"'; ?> readonly/>
			<table border="0"><tr><td><input type="radio" class="check"  name="pagrec" placeholder="" value="pago" <?php 
			if($info['debitocredito'] == "debito"){ echo 'checked'; }?> readonly/></td>
			<td><label class="label-bancos">Valor pago</label></td>
				<td width="40px"></td>
        	<td><input type="radio" class="check"  name="pagrec" placeholder="" value="recebido" <?php
			if($info['debitocredito'] == "credito"){ echo 'checked'; }?> readonly/><td>
			<td><label class="label-bancos">Valor recebido</label><td>
		</table>
        <input style="width: 250px;" type="date"  name="data" placeholder="" <?php echo 'Value = "' . $info['data'] . '"'; ?> readonly/>
		<select name="transacao" class="select-transacao" aria-label="Default select example" readonly>
 		<option class="select-transacao" value="1000"  selected>Tipos de transaçao</option>
		<?php 
			$sql_code = "SELECT * FROM `transacoes`";
        	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
			while($dados = $sql_query->fetch_array()){
					if ($info['id_transacao'] == $dados['id_transacao']){
						echo "<option value='".$dados['id_transacao']."' selected>".$dados['transacao']."</option>";
					}else{
						echo "<option value='".$dados['id_transacao']."'>".$dados['transacao']."</option>";
					}
				}
		?>
		</select>
        <input type="text"  name="descricao" placeholder="Descriçao" <?php echo 'Value = "' . $info['descricao'] . '"'; ?> readonly/>
		<br>
		
		

		<input type="hidden" name="flag" value="1" />
		<div style="display:grid;">	
			<button class="button-transacao" type="submit">Confirma Exclusão?</button><br>
			<button class="button-transacao" onclick="location.href='extrato.php'">Voltar</button>
		</div>
	</div>
	
	
	</form>
</body>
</html>