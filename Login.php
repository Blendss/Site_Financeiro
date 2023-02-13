<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {
$email = $_POST['email'];
$senha = $_POST['senha'];

	if(strlen($_POST['email']) == 0) {
		echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $sql_code = "SELECT * FROM contas WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		$quantidade = $sql_query->num_rows;
		$usuario = $sql_query->fetch_assoc();
		
		
		
		if($quantidade == 1) {
			session_start();
            $_SESSION['id']   = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
			header("Location: extrato.php");
			
			
			
		}else{
			$sql_code = "SELECT * FROM contas WHERE email = '$email'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
			$quantidade = $sql_query->num_rows;
			
			if($quantidade == 1){
				echo 'senha incorreta';
				
			}else{
				
				echo 'conta nao cadastrada. clique no link crie uma nova conta';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="cadastro.css" href="login.css"/>
    <link
		href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
		rel="stylesheet"
    />
  </head>
  <body>
  <div class="box">
		<div style="position:absolute" class="item1"><h1>Acesse a sua Conta</h1></div>
		<div class="item2">
		<input class="cb-input" type="checkbox" id="switch"><label class="cb-label" for="switch">Toggle</label>
		<div class="moon"><div class="gg-sun"></div></div>
		</div>
	</div>
	<div>
	  	<form action="" method="POST">
        	<input type="text" name="email" placeholder="Email" />
        	<input type="password"  name="senha" placeholder="Senha" />
			<br><br>
			<button type="submit">Enviar</button>
        </form>
    
	 </div>
	  <br>
	 <div>
	 
		<p class="p14">
      	Nao possui uma Conta? <a style=" font-family: Arial, Helvetica, sans-serif;"href="novaconta.php">Crie uma nova Conta aqui!</a>
    	</p>
	  
	 </div>
	  
	 <script src="index.js"></script>
  </body>
</html>
