<?php
include('conexao.php');
session_start();
$id = $_SESSION['id'];
$nome = $_SESSION['nome'];

error_reporting(0); //para de aparecer error messages na tela

function puxadado($codigododado,$id, $mes){
	$dadoatual = 0;
	include('conexao.php');
	$sql_code = "SELECT * FROM extrato WHERE id = $id AND cod_gasto = $codigododado AND MONTH(data) = $mes";
	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
	while($dados = $sql_query->fetch_array()){
    if($dados['debitocredito'] == 'debito' ){
      $dadoatual += $dados['valor'];
    }
}
return $dadoatual;
}

function arrayData($month, $id){
	$phpArray = array();
	$mesUsuario = $month;
	// $mesUsuario = 0;
	if ($mesUsuario < 1 || $mesUsuario >12){
		$mesAtual = date('m');
		$mesAtual = intval($mesAtual);
		$mesUsuario = 0;
	}


	if ($mesUsuario == 0){
		switch ($mesAtual) {
			case 1:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Janeiro', puxadado(1,$id, 1), puxadado(2,$id, 1), puxadado(3,$id, 1), puxadado(6,$id, 1), puxadado(5,$id, 1), puxadado(4,$id, 1))
				);
				break;
			case 2:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Fevereiro', puxadado(1,$id, 2), puxadado(2,$id, 2), puxadado(3,$id, 2), puxadado(6,$id, 2), puxadado(5,$id, 2), puxadado(4,$id, 2))
				);
				break;
			case 3:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Março', puxadado(1,$id, 3), puxadado(2,$id, 3), puxadado(3,$id, 3), puxadado(6,$id, 3), puxadado(5,$id, 3), puxadado(4,$id, 3))
				);
				break;
			case 4:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Abril', puxadado(1,$id, 4), puxadado(2,$id, 4), puxadado(3,$id, 4), puxadado(6,$id, 4), puxadado(5,$id, 4), puxadado(4,$id, 4))
				);
				break;
			case 5:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Maio', puxadado(1,$id, 5), puxadado(2,$id, 5), puxadado(3,$id, 5), puxadado(6,$id, 5), puxadado(5,$id, 5), puxadado(4,$id, 5))
				);
				break;
			case 6:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Junho', puxadado(1,$id, 6), puxadado(2,$id, 6), puxadado(3,$id, 6), puxadado(6,$id, 6), puxadado(5,$id, 6), puxadado(4,$id, 6))
				);
				break;
			case 7:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Julho', puxadado(1,$id, 7), puxadado(2,$id, 7), puxadado(3,$id, 7), puxadado(6,$id, 7), puxadado(5,$id, 7), puxadado(4,$id, 7))
				);
				break;
			case 8:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Agosto', puxadado(1,$id, 8), puxadado(2,$id, 8), puxadado(3,$id, 8), puxadado(6,$id, 8), puxadado(5,$id, 8), puxadado(4,$id, 8))
				);
				break;
			case 9:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Setembro', puxadado(1,$id, 9), puxadado(2,$id, 9), puxadado(3,$id, 9), puxadado(6,$id, 9), puxadado(5,$id, 9), puxadado(4,$id, 9))
				);
				break;
			case 10:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Outubro', puxadado(1,$id, 10), puxadado(2,$id, 10), puxadado(3,$id, 10), puxadado(6,$id, 10), puxadado(5,$id, 10), puxadado(4,$id, 10))
				);
				break;
			case 11:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Novembro', puxadado(1,$id, 11), puxadado(2,$id, 11), puxadado(3,$id, 11), puxadado(6,$id, 11), puxadado(5,$id, 11), puxadado(4,$id, 11))
				);
				break;
			case 12:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Dezembro', puxadado(1,$id, 12), puxadado(2,$id, 12), puxadado(3,$id, 12), puxadado(6,$id, 12), puxadado(5,$id, 12), puxadado(4,$id, 12))
				);
				break;
			default:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('', puxadado(1,$id, $mesAtual), puxadado(2,$id, $mesAtual), puxadado(3,$id, $mesAtual), puxadado(6,$id, $mesAtual), puxadado(5,$id, $mesAtual), puxadado(4,$id, $mesAtual))
				);
				break;
		}
	}
	else{
		switch ($mesUsuario) {
			case 1:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Janeiro', puxadado(1,$id, 1), puxadado(2,$id, 1), puxadado(3,$id, 1), puxadado(6,$id, 1), puxadado(5,$id, 1), puxadado(4,$id, 1)),
					array('Fevereiro', puxadado(1,$id, 2), puxadado(2,$id, 2), puxadado(3,$id, 2), puxadado(6,$id, 2), puxadado(5,$id, 2), puxadado(4,$id, 2)),
					array('Março', puxadado(1,$id, 3), puxadado(2,$id, 3), puxadado(3,$id, 3), puxadado(6,$id, 3), puxadado(5,$id, 3), puxadado(4,$id, 3)),
					array('Abril', puxadado(1,$id, 4), puxadado(2,$id, 4), puxadado(3,$id, 4), puxadado(6,$id, 4), puxadado(5,$id, 4), puxadado(4,$id, 4)),
					array('Maio', puxadado(1,$id, 5), puxadado(2,$id, 5), puxadado(3,$id, 5), puxadado(6,$id, 5), puxadado(5,$id, 5), puxadado(4,$id, 5)),
					array('Junho', puxadado(1,$id, 6), puxadado(2,$id, 6), puxadado(3,$id, 6), puxadado(6,$id, 6), puxadado(5,$id, 6), puxadado(4,$id, 6))
				);
				break;
			case 2:
				$phpArray = array(
					array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
					array('Julho', puxadado(1,$id, 7), puxadado(2,$id, 7), puxadado(3,$id, 7), puxadado(6,$id, 7), puxadado(5,$id, 7), puxadado(4,$id, 7)),
					array('Agosto', puxadado(1,$id, 8), puxadado(2,$id, 8), puxadado(3,$id, 8), puxadado(6,$id, 8), puxadado(5,$id, 8), puxadado(4,$id, 8)),
					array('Setembro', puxadado(1,$id, 9), puxadado(2,$id, 9), puxadado(3,$id, 9), puxadado(6,$id, 9), puxadado(5,$id, 9), puxadado(4,$id, 9)),
					array('Outubro', puxadado(1,$id, 10), puxadado(2,$id, 10), puxadado(3,$id, 10), puxadado(6,$id, 10), puxadado(5,$id, 10), puxadado(4,$id, 10)),
					array('Novembro', puxadado(1,$id, 11), puxadado(2,$id, 11), puxadado(3,$id, 11), puxadado(6,$id, 11), puxadado(5,$id, 11), puxadado(4,$id, 11)),
					array('Dezembro', puxadado(1,$id, 12), puxadado(2,$id, 12), puxadado(3,$id, 12), puxadado(6,$id, 12), puxadado(5,$id, 12), puxadado(4,$id, 12))
				);
				break;
			default:
			$phpArray = array(
				array('Datas', 'Educação', 'Saúde', 'Lazer', 'Moradia', 'Transporte', 'Outros'),
				array('Janeiro', puxadado(1,$id, 1), puxadado(2,$id, 1), puxadado(3,$id, 1), puxadado(6,$id, 1), puxadado(5,$id, 1), puxadado(4,$id, 1)),
				array('Fevereiro', puxadado(1,$id, 2), puxadado(2,$id, 2), puxadado(3,$id, 2), puxadado(6,$id, 2), puxadado(5,$id, 2), puxadado(4,$id, 2)),
				array('Março', puxadado(1,$id, 3), puxadado(2,$id, 3), puxadado(3,$id, 3), puxadado(6,$id, 3), puxadado(5,$id, 3), puxadado(4,$id, 3)),
				array('Abril', puxadado(1,$id, 4), puxadado(2,$id, 4), puxadado(3,$id, 4), puxadado(6,$id, 4), puxadado(5,$id, 4), puxadado(4,$id, 4)),
				array('Maio', puxadado(1,$id, 5), puxadado(2,$id, 5), puxadado(3,$id, 5), puxadado(6,$id, 5), puxadado(5,$id, 5), puxadado(4,$id, 5)),
				array('Junho', puxadado(1,$id, 6), puxadado(2,$id, 6), puxadado(3,$id, 6), puxadado(6,$id, 6), puxadado(5,$id, 6), puxadado(4,$id, 6))
			);
				break;
		}
	}
	return $phpArray;
}


/*tentei um try except pra arrumar o erro já que ele tenta pegar dados de um form que ainda não carregou (PHP roda antes do HTML)
function teoriaValor():int{
	class Falhou extends Exception {} //pensei que com isso ele fosse dar override no Exception e executar varios nada, não funcionou 
	try{
		$teoria = $_POST['dataMes']; //sa bosta ainda da throw Error_Warning então não adiantou de nada, tive que impedir de mostrar mensagens de erro na tela
	}
	catch(Falhou){
		$teoria = 0;
	}
	return intval($teoria);
}

$teoria = teoriaValor(); */
$pratica = 0;
if ($teoria > 0 && $teoria <= 12){
	$pratica = intval($teoria);
}
$phpArray = arrayData($pratica, $id);

$js_array = json_encode($phpArray);
echo "<script>let JS_Array = ". $js_array . ";</script>";
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title >Extrato</title>
<link rel="stylesheet" href="cadastro.css" href="login.css"/>
<script src="https://kit.fontawesome.com/3862e9d2b8.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

		var data = google.visualization.arrayToDataTable(
			JS_Array
		);

      var view = new google.visualization.DataView(data);
      view.setColumns(
	[ 0, //isso aq são os meses
	  1,{calc:"stringify", sourceColumn: 1, type: "string", role: "annotation"},
	  2,{calc:"stringify", sourceColumn: 2, type: "string", role: "annotation"},
	  3,{calc:"stringify", sourceColumn: 3, type: "string", role: "annotation"},
	  4,{calc:"stringify", sourceColumn: 4, type: "string", role: "annotation"},
	  5,{calc:"stringify", sourceColumn: 5, type: "string", role: "annotation"},
	  6,{calc:"stringify", sourceColumn: 6, type: "string", role: "annotation"},
	]);

      var options = {
        title: "Divisão de gastos",
         'backgroundColor': 'transparent',
        // width: 500,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
      chart.draw(view, options);
  	}
	function firstLoad(){
		document.forms['formMes'].submit();
	}
  </script>
<!-- <div id="columnchart_values" style="width: 900px; height: 300px;"></div> -->

<div class="navigation" style="z-index: 400">
        <button style="margin: 0px 0px" class="hamburger" onclick="show()">
            <div style="margin: 0px -10px" id="bar1" class="bar"></div>
            <div style="margin: 0px -10px" id="bar2" class="bar"></div>
            <div style="margin: 0px -10px" id="bar3" class="bar"></div>
        </button>
		 <?php //echo $banco; ?>
		 <nav>
            <ul style="background-color: #224912;">
				<li>
					<div class="dark-light-mode">
						<input type="checkbox" id="switch" style="display: none; float: right;">
						<label for="switch" style="cursor: pointer;float:right;" id="switchLabel">
							<i class="fa-regular fa-moon" style="color: #899095;"></i>
						</label>
					</div>
				</li>
                <li><a>Conta</a></li>
                <li><a href="financas.php">Finanças</a></li>
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
			<li><img
				style="margin:30px 300px"
				src="img/Screenshot_1.png"
				width="450"
				height="100"
				align="middle"
			/></li>
		</ul>
		<!-- <div style="right: 10px" class="chartcs" id="chart_div"></div> -->
        <div style="margin: 61px 0px">
	<div class="backtittlee">
	<h2 class="tab" style="color: #fafafa;">Visão Financeira</h2>
	</div>
	</div>
    <br>
	
	<table style="text-align:center; padding-top: 0px; margin: -10px 0px" class="table-extrato" border = 0 CELLSPACING=0 CELLPADDING=5. >
		<tr style="text-align:center;" style="border-bottom: 10px">
		<th width="5200px"><label class="label-bancos"></label></th>
		<th style="border-radius: 0px 30px 30px 0px;" width="0px"><label class="label-bancos"></label></th>
		</tr>
	</table>

	<div>
														  <!-- aponta pro proprio arquivo 
		<form onload="firstLoad()" name="formMes" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<select onchange="this.form.submit()" name="dataMes" id="dataMes" style="">
				<option value="0" selected hidden>Selecione o mês desejado</option>
				<option value="0">Mês atual</option>
				<option value="1">Janeiro até Junho</option>
				<option value="2">Julho até Dezembro</option>
			</select>
		</form>-->
	</div>
	<div style="right: 10px" class="chartcs" id="chart_div"></div>
	<div style="right: 10px" class="chartcs" id="chart_div2"></div>
