<?php
include('conexao.php');
session_start();
$id = $_SESSION['id'];
$nome = $_SESSION['nome'];



	

$sql_code = "SELECT * FROM `extrato` WHERE id = ". $id ." ORDER BY data ASC";	
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
$saldo = 0;		
while($dados = $sql_query->fetch_array()){ 		
if ($dados['debitocredito'] == 'credito'){		
	$saldo += $dados['valor'];		
}else{		
	$saldo -= $dados['valor'];		
}		
}

//----------------------ExtratoTotal----------------------
$extratoInd = "SELECT `debitocredito` FROM `extrato` WHERE id=".$id." ORDER BY `data` ASC";
$sql_query_ExtratoInd = $mysqli->query($extratoInd) or die("Falha na execução do código SQL: " . $mysqli->error);
$arrExtrato = array();
$arrValorRecebido = array();
$arrValorRecebidoIndex = array();
$arrValorPago = array();
$arrValorPagoIndex = array();

if ($sql_query_ExtratoInd->num_rows > 0) {
	while($row = $sql_query_ExtratoInd->fetch_assoc()) {
		array_push($arrExtrato, $row["debitocredito"]);
	}
}
//$arrExtrato = todos index

//----------------------Separar Credito e Debito----------------------
foreach ($arrExtrato as $key => $value) {
	if ($value == "credito"){
		array_push($arrValorRecebidoIndex, $key);
	}
	//		Index de qual é credito e qual é debito
	elseif ($value == "debito"){
		array_push($arrValorPagoIndex, $key);
	}
}

$extrato = "SELECT * FROM `extrato` WHERE id=".$id." ORDER BY `data` ASC";
$sql_query_Extrato = $mysqli->query($extrato) or die("Falha na execução do código SQL: " . $mysqli->error);
$index = 0;
$cd = 0;
$deb = 0;
if ($sql_query_Extrato->num_rows > 0) {
	// echo "foi";
	print_r($arrValorRecebidoIndex);
	echo "<br>";
	print_r($arrValorPagoIndex);
	echo "<br>";
	echo $index;
	while($row = $sql_query_Extrato->fetch_assoc()) {
		if (array_search($index, $arrValorRecebidoIndex)){
			array_push($arrValorRecebido, $row["valor"]);
			$cd +=1;
		}
		// if (array_search($index, $arrValorPagoIndex)){
		// 	array_push($arrValorPago, $row["valor"]);
		// 	$deb+=1;
		// }
		$index += 1;
	}
}
echo "<br>";
echo $cd;
echo "<br>";
echo $deb;
//----------------------valorPago----------------------
// // $valorPago = "SELECT `valor` FROM `extrato` WHERE id=".$id." and `debitocredito`='debito' ORDER BY `data` ASC";
// // $sql_query_valorPago = $mysqli->query($valorPago) or die("Falha na execução do código SQL: " . $mysqli->error);
// // $arrValorPago = array();
// // if ($sql_query_valorPago->num_rows > 0) {
// // 	while($row = $sql_query_valorPago->fetch_assoc()) {
// // 		array_push($arrValorPago, $row["valor"]);
// // 	}
// // }
//----------------------valorRecebido----------------------
// // $valorRecebido = "SELECT `valor` FROM `extrato` WHERE id=".$id." and `debitocredito`='credito' ORDER BY `data` ASC";
// // $sql_query_valorRecebido = $mysqli->query($valorRecebido) or die("Falha na execução do código SQL: " . $mysqli->error);
// // $arrValorRecebido = array();
// // if ($sql_query_valorRecebido->num_rows > 0) {
// // 	while($row = $sql_query_valorRecebido->fetch_assoc()) {
// // 		array_push($arrValorRecebido, $row["valor"]);
// // 	}
// // }
//----------------------Data---------------------- não fiz
// // $dataExtrato = "SELECT `valor` FROM `extrato` WHERE id=".$id." and `debitocredito`='credito' ORDER BY `data` ASC";
// // $sql_query_valorRecebido = $mysqli->query($valorRecebido) or die("Falha na execução do código SQL: " . $mysqli->error);
// // $arrValorRecebido = array();
// // if ($sql_query_valorRecebido->num_rows > 0) {
// // 	while($row = $sql_query_valorRecebido->fetch_assoc()) {
// // 		array_push($arrValorRecebido, $row["valor"]);
// // 	}
// // }
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title >Extrato</title>
<link rel="stylesheet" href="cadastro.css" href="login.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	
	
<script>
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawAxisTickColors);

function drawAxisTickColors() {
	var data = new google.visualization.DataTable();
	data.addColumn('number', 'Tempo');
	data.addColumn('number', 'Recebido');
	data.addColumn('number', 'Pago');
	$indexCondition = 0;
	// $arryDataRow = array();

	// for (let i = 0; i < ; i++) {
	// 	array_push($arryDataRow,[i, $arrValorRecebido[i], $arrValorPago[i]])
	// }
	// if ($sql_query_Extrato->num_rows > 0) {
	// 	while($row = $sql_query_Extrato->fetch_assoc()) {
	// 		array_push($arrExtrato, $row["debitocredito"]);
	// 	}
	// }

	data.addRows(
		[
		[0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
		[6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
		[12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
		[18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
		[24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
		[30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
		[36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
		[42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
		[48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
		[54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
		[60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
		[66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
	]
	);

	var options = {
		chart: {
			title: 'Histórico de gastos',
			subtitle: ''
		},

		hAxis: {
		title: 'Time',
		textStyle: {
			color: '#00a800',
			fontSize: 20,
			fontName: 'Arial',
			bold: true,
		},
		titleTextStyle: {
			color: '#000000',
			fontSize: 16,
			bold: true,
		}
		},
		vAxis: {
		title: 'Popularity',
		textStyle: {
			color: '#1a237e',
			fontSize: 24,
			bold: true
		},
		titleTextStyle: {
			color: '#000000',
			fontSize: 24,
			bold: true
		}
		},
		colors: ['#00a800', '#ff0000'],
		width: 800,
		height: 500
	};
	// var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	// chart.draw(data, options);
	var chart = new google.charts.Line(document.getElementById('chart_div'));
	chart.draw(data, options);
	}


</script>
	
<div class="navigation">
        <button style="margin: 0px 0px" class="hamburger" onclick="show()">
            <div style="margin: 0px -10px" id="bar1" class="bar"></div>
            <div style="margin: 0px -10px" id="bar2" class="bar"></div>
            <div style="margin: 0px -10px" id="bar3" class="bar"></div>
        </button>
		 <?php //echo $banco; ?>
        <nav>
            <ul style="background-color: #224912;">
				<li><div class="box"> <input style="margin: 0px 0px" class="cb-input" type="checkbox" id="switch"><label class="cb-label" for="switch"></label>
				<div class="moon"><div class="gg-sun"></div></div> </div> </li>
                <li><a>Conta</a></li>
                <li><a>Bancos</a></li>
                <li><a>Configuraçôes</a></li>
				<li><a href="extrato.php">Extrato</a></li>
				<li><a href="financas.php">Finanças</a></li>
                <li><a href="Login.php">Sair</a></li>
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
				<tr><td><h3>Você está no: </h3>  
					

				<form  action="" method="POST">
				<select onchange="this.form.submit()" name="procure" class="select-bancoss" aria-label="Default select example">
					<?php 
				
					$sql_code = "SELECT * FROM usuariobancos JOIN bancos ON usuariobancos.cod = bancos.cod WHERE id = $id ORDER BY usuariobancos.cod;";
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);		
					
					if(isset($_POST['flag'])){
						echo "//////////////////////////////////////". $_POST['procure'];

						$primeirobanco = $_POST['procure'];
					}else{$primeirobanco = '9999';}
					
					echo "oioioioioio". $primeirobanco;
					
					while($dados = $sql_query->fetch_array()){
						if($primeirobanco == '9999'){
							echo "<option selected style='font-weight: bold;' value='".$dados['cod']."'>".$dados['banco']."</option>";
						}elseif($primeirobanco == $dados['cod']){
							echo "<option selected style='font-weight: bold;' value='".$dados['cod']."'>".$dados['banco']."</option>";
						}else{
							echo "<option style='font-weight: bold;' value='".$dados['cod']."'>".$dados['banco']."</option>";
						}
							
						
						if ($primeirobanco == '9999'){
							$primeirobanco = $dados['cod'];
						}	
						}
						$_SESSION['cod_banco'] = $primeirobanco;
					?>
				</select>
				<input type="hidden" name="flag" value="1" />
				</form>

					</td></tr>
			</table></li>
			<li>
				<img
				style="margin:30px 300px"
				src="img/Screenshot_1.png"
				width="450"
				height="100"
				align="middle"
			/></li>
		</ul>
		<div style="width: 1000px" class="chartcs" id="chart_div"></div>
		<?php 
	$hoje = date('Y/m/d');
	$sql_code = "SELECT * FROM `extrato` JOIN transacoes ON extrato.id_transacao = transacoes.id_transacao WHERE id = ". $id ." and cod_banco = ".$primeirobanco." and data >= '". $hoje ."' ORDER BY data ASC";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
	$quantidade = $sql_query->num_rows;
	if ($quantidade != 0){ ?>
	<div style="margin: 61px 0px">
	<div class="backtittlee">
	<h2 class="tab" style="color: #fafafa;">Transações futuras</h2>
	</div>
	</div>
	<br>
	<table style="text-align:center; padding-top: 0px; margin: -10px 0px" class="table-extrato" border = 0 CELLSPACING=0 CELLPADDING=5. >
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
			<td class="tdd">R$ <?php echo number_format($dados['valor'],2,",","."); ?></td>
				<td class="tdd" width="20px"</td>
			<td class="tdd"><?php 
				echo $dados['descricao'];
				?></td>
			<td class="tdd"><a href="editatransacao.php?registro=<?php echo $dados['registro']; ?>"><i style="font-size:24px" class="fa">&#xf040;</i></a></td>
			<td class="tdd"><a href="excluitransacao.php?registro=<?php echo $dados['registro']; ?>"><i style="font-size:24px" class="fa">&#xf014;</i></a></td>
			</tr>
		<?php }
		}
		?>
	</table>
	<div >
	<div class="backtittle" >
	<h2 class="tab" style="background: #288E1D; color: #fafafa;">Extrato</h2>
	</div>
	</div>
	<table style="text-align:center; padding-top: 50px;" class="table-extrato" border = 0 CELLSPACING=0 CELLPADDING=5. >
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
		$sql_code = "SELECT * FROM `extrato` JOIN transacoes ON extrato.id_transacao = transacoes.id_transacao WHERE id = ". $id ." and cod_banco = ".$primeirobanco." and data <= '". $hoje ."' ORDER BY data DESC";
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