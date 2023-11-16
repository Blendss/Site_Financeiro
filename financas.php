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
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title >Extrato</title>
<link rel="stylesheet" href="cadastro.css" href="login.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!-- teste Grafico JS
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Educação', 3],
          ['Saúde', 1],
          ['Lazer', 1],
          ['Moradia', 1],
		  ['Transporte', 1],
          ['Outros', 2]
        ]);
        var options = {	'title':'Divisão de Gastos',
						'backgroundColor': 'transparent',
                       	'width':400,
                       	'height':300};
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	-->
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
			<li><img
				style="margin:30px 300px"
				src="img/Screenshot_1.png"
				width="450"
				height="100"
				align="middle"
			/></li>
		</ul>
		<div style="right: 10px" class="chartcs" id="chart_div"></div>
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