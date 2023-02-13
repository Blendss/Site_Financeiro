<?php
include('conexao.php');
session_start();
$id = $_SESSION['id'];
$nome = $_SESSION['nome'];

$sql_code = "SELECT * FROM `extrato` WHERE id = ". $id ." ORDER BY ano,mes,dia DESC";		
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);		
$saldo = 0;		
while($dados = $sql_query->fetch_array()){ 		
if ($dados['debitocredito'] == 'credito'){		
	$saldo = $saldo + $dados['valor'];		
}else{		
	$saldo = $saldo - $dados['valor'];		
}		
}
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title >Extrato</title>
<link rel="stylesheet" href="cadastro.css" href="login.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div class="navigation">
        <button style="margin: 0px 0px" class="hamburger" onclick="show()">
            <div style="margin: 0px -10px" id="bar1" class="bar"></div>
            <div style="margin: 0px -10px" id="bar2" class="bar"></div>
            <div style="margin: 0px -10px" id="bar3" class="bar"></div>
        </button>
        <nav>
            <ul style="background-color: #224912;">
				<li><div class="box"> <input style="margin: 0px 0px" class="cb-input" type="checkbox" id="switch"><label class="cb-label" for="switch"></label>
				<div class="moon"><div class="gg-sun"></div></div> </div> </li>
                <li><a>Home</a></li>
                <li><a>About</a></li>
                <li><a>Blog</a></li>
                <li><a>Contact</a></li>
            </ul>
        </nav>
    </div>
<body style="margin: 0;">
<script src="index.js"></script>
		<ul>
			<li><img src="img/profileplaceholder.png" id="upload-img" width="120" height="120" style="margin:20px 10px"></li>
			<li><table style="margin: 40px 0px">
				<tr><td><h2>Olá, <?php echo $nome; ?></h2></td></tr>
				<tr><td><h1>Seu saldo: R$ <?php echo number_format($saldo,2,",","."); ?></h1></td></tr>
			</table></li>
			<li><img
				style="margin:30px 300px"
				src="img/Screenshot_1.png"
				width="450"
				height="100"
				align="middle"
			/></li>
		</ul>
	<h2 style="margin: 20px 70px">Transações futuras</h2>
	<br>
	<?php 
	$hoje = date('Y/m/d');
	$sql_code = "SELECT * FROM `extrato` JOIN transacoes ON extrato.id_transacao = transacoes.id_transacao WHERE id = ". $id ." and data >= '". $hoje ."' ORDER BY data ASC";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
	$quantidade = $sql_query->num_rows;
	if ($quantidade != 0){ ?>
		<table class="table-extrato" border = 0 CELLSPACING=0 CELLPADDING=5.>
		<tr>
		<th width="100px"><label class="label-bancos">Data</label></th>
		<th width="180px" ><label class="label-bancos">Tipo de transação</label></th>
		<th width="300px" ><label class="label-bancos">Pessoa/Instituição</label></th>
		<th></th>
		<th width="190px"><label class="label-bancos">Valor da transação</label></th>
		<th width="20px"></th>
		<th width="300px"><label class="label-bancos">Detalhes</label></th>
		<th width="0px"><label class="label-bancos">Editar</label></th>
		<th style="border-radius: 0px 30px 30px 0px;" width="0px"><label class="label-bancos">Apagar</label></th>
		</tr>
			</tr>
		
		<?php
		while($dados = $sql_query->fetch_array()){ 
		?>
			<tr>
			<td class="tdd" width="100px"><?php $dataformat = date_create($dados['data']); echo date_format($dataformat,"d/m/Y"); ?></td>
			<td class="tdd" width="180px"><?php
				echo $dados['transacao']."</td>";
				?>
			<td class="tdd" width="300px"><?php echo $dados['nome'] ?></td>
			<td class="tdd"><?php 
				if ($dados['debitocredito'] == 'credito'){
					echo '<img src="img/Sem-Título-1.gif"/>';
				}else{
					echo '<img src="img/seta_vermelha.gif"/>';
				}
				
				
				?></td>
			<td class="tdd" align="right">R$ <?php echo number_format($dados['valor'],2,",","."); ?></td>
				<td class="tdd" width="20px"</td>
			<td class="tdd"><?php 
				echo $dados['descricao'];
				?></td>
			<td><a href="editatransacao.php?registro=<?php echo $dados['registro']; ?>"><i style="font-size:24px" class="fa">&#xf040;</i></a></td>
			<td><a href="excluitransacao.php?registro=<?php echo $dados['registro']; ?>"><i style="font-size:24px" class="fa">&#xf014;</i></a></td>
			</tr>
		<?php }
		}
		?>
	</table>
	<div>
	<div style="margin: -20px 0px;" class="backtittle">
	<h2 style="margin: 0px 0px; color: black;" class="tittle">Extrato</h2>
	</div>
	</div>
	<table style="text-align:center" class="table-extrato" border = 0 CELLSPACING=0 CELLPADDING=5. >
		<tr style="text-align:center;" style="border-bottom: 10px">
		<th width="100px"><label class="label-bancos">Data</label></th>
		<th width="180px"><label class="label-bancos">Tipo de transação</label></th>
		<th width="300px"><label class="label-bancos" style="justify-content: center;" >Pessoa/Instituição</label></th>
		<th></th>
		<th width="190px"><label class="label-bancos" style="justify-content: center;">Valor da transação</label></th>
		<th width="20px"></th>
		<th width="300px"><label class="label-bancos" style="justify-content: center;">Detalhes</label></th>
		<th width="0px"><label class="label-bancos">Editar</label></th>
		<th style="border-radius: 0px 30px 30px 0px;" width="0px"><label class="label-bancos">Apagar</label></th>
		</tr>

		<?php
		$sql_code = "SELECT * FROM `extrato` JOIN transacoes ON extrato.id_transacao = transacoes.id_transacao WHERE id = ". $id ." and data <= '". $hoje ."' ORDER BY data DESC";
		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		while($dados = $sql_query->fetch_array()){ 
		?>
			<tr>
			<td class="tdd" width="100px"><?php $dataformat = date_create($dados['data']); echo date_format($dataformat,"d/m/Y"); ?></td>
			<td class="tdd" width="180px"><?php
				echo $dados['transacao']."</td>";
				?>
			<td style="text-align:center" class="tdd" width="300px"><?php echo $dados['nome'] ?></td>
			<td class="tdd"><?php 
				if ($dados['debitocredito'] == 'credito'){
					echo '<img src="img/Sem-Título-1.gif"/>';
				}else{
					echo '<img src="img/seta_vermelha.gif"/>';
				}
				
				
				?></td>
			<td style="text-align:center" class="tdd" align="right">R$ <?php echo number_format($dados['valor'],2,",","."); ?></td>
			<td class="tdd" width="20px"</td>
			<td class="tdd"><?php 
				echo $dados['descricao'];
				?></td>
			<td class="tdd"><a href="editatransacao.php?registro=<?php echo $dados['registro']; ?>"><i style="font-size:24px" class="fa">&#xf040;</i></a></td>
			<td class="tdd"><a href="excluitransacao.php?registro=<?php echo $dados['registro']; ?>"><i style="font-size:24px" class="fa">&#xf014;</i></a></td>
			</tr>

		<?php }
		?>
	</table>
<br>
<a style="position: fixed; top: 90%; left: 75%; width: 75px; height: 73px;" href="incluitransacao.php" class="adiçao">
	<img
	src="img/adicao.png"
	/>
</a>
</body>
</html>