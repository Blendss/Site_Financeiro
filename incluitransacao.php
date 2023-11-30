<?php
include('conexao.php');
session_start();
$id = $_SESSION['id'];
$cod_banco = $_SESSION['cod_banco'];


if(isset($_POST['nome']) || isset($_POST['valor']) || isset($_POST['pagrec']) || isset($_POST['data']) || isset($_POST['descricao'])  || isset($_POST['transacao'])) {
	
   if(strlen($_POST['nome']) == 0) {
	   echo "Preencha o nome da pessoa/instituicao";
    } else if(strlen($_POST['valor']) == 0) {
        echo "Preencha o valor";
    } else if(!isset($_POST['pagrec'])) {
        echo "Preencha entre pago ou recebido";
    } else if(strlen($_POST['data']) == 0) {
        echo "Preencha a data";
    } else if($_POST['transacao'] == 1000) {
        echo "Escolha um tipo de transacao";
    } else {
	    if($_POST['pagrec'] == "pago"){
			$pagrec = "debito";
		}else{
			$pagrec = "credito";
		}
	    $ano = substr($_POST['data'],0,4);
	    $mes = substr($_POST['data'],5,2);
	   	$dia = substr($_POST['data'],8,2);
	    $ano_int = intval($ano);
	    $mes_int = intval($mes);
	    $dia_int = intval($dia);
		$sql_code = "INSERT INTO `extrato`(`id`, `data`, `valor`, `debitocredito`, `id_transacao`, `descricao`, `nome`,`cod_banco`) VALUES ('" . $id . "','".$_POST['data']."','" . $_POST['valor'] . "','" . $pagrec . "','" . $_POST	['transacao'] . "','" . $_POST['descricao'] . "','" . $_POST['nome'] . "','" . $cod_banco . "')";
		echo $sql_code;
	   	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
	   	header("Location: extrato.php");
    }
	
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="cadastro.css" />
   <script src="index.js"></script>
</head>

<body>
	<div align="center">
	<h1>Adicionar Transação</h1>
	</div>
	<div align="center">
	<form action="" method="POST" autocomplete="off">
        <input type="text" name="nome" placeholder="Nome da pessoa/instituiçao" <?php if(isset($_POST['nome'])) { echo 'Value = "' . $_POST['nome'] . '"'; } ?>/>
        <input type="number"  name="valor" placeholder="Valor pago/recebido" <?php if(isset($_POST['valor'])){ echo 'Value = "' . $_POST['valor'] . '"'; } ?>/>
			<table border="0"><tr><td><input type="radio" class="check"  name="pagrec" placeholder="" value="pago" <?php if(isset($_POST['pagrec'])){ if($_POST['pagrec'] == "pago"){ echo 'checked'; }}?>/></td>
			<td><label class="label-bancos">Valor pago</label></td>
				<td width="40px"></td>
        	<td><input type="radio" class="check"  name="pagrec" placeholder="" value="recebido" <?php if(isset($_POST['pagrec'])){ if($_POST['pagrec'] == "recebido"){ echo 'checked'; }}?>/><td>
			<td><label class="label-bancos">Valor recebido</label><td>
		</table>
        <input style="width: 250px;" type="date"  name="data" placeholder="" <?php if(isset($_POST['data'])) { echo 'Value = "' . $_POST['data'] . '"'; } ?>/>
		<select name="transacao" class="select-transacao" aria-label="Default select example">
 		<option class="select-transacao" value="1000"  selected>Tipos de transaçao</option>
		<?php 
			$sql_code = "SELECT * FROM `transacoes`";
        	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
			while($dados = $sql_query->fetch_array()){
				if(isset($_POST['transacao'])){
					if ($_POST['transacao'] == $dados['id_transacao']){
						echo "<option value='".$dados['id_transacao']."' selected>".$dados['transacao']."</option>";
					}else{
						echo "<option value='".$dados['id_transacao']."'>".$dados['transacao']."</option>";
					}
				}else{
					echo "<option value='".$dados['id_transacao']."'>".$dados['transacao']."</option>";
				}
		}
		?>
		</select>
        <input type="text"  name="descricao" placeholder="Descriçao" <?php if(isset($_POST['descricao'])) { echo 'Value = "' . $_POST['descricao'] . '"'; } ?>/>
		<br>
		
		
		<div style="display:grid;">	
			<button class="button-transacao" type="submit">Adicionar</button><br>
			<button class="button-transacao" onclick="location.href='extrato.php'">Voltar</button>
		</div>
		

	
	</form>
	<br><br>
	
	</div>

</body>
</html>