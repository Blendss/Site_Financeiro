<?php
include ('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha']) || isset($_POST['nome'])) {



   if(strlen($_POST['nome']) == 0) {
	   echo "Preencha seu nome";
    } else if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
	   if(($_POST['senha']) == ($_POST['confirma'])){
		   
		
		   
		   
		$sql_code = "INSERT INTO `contas`(`email`, `senha`, `nome`, `cpf`, `cnpj`) VALUES ('".$_POST['email']."','".$_POST['senha']."','".$_POST['nome']."','0','0')";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
		  
		   
		$sql_code = "SELECT * FROM `contas` WHERE email = '".$_POST['email']."'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error); 
		$usuario = $sql_query->fetch_assoc();
		   
		   
		session_start();
        $_SESSION['id']   = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
		header("Location: cadastrabanco.php");   
		   
	   }else{
		   echo 'senhas diferentes!';
		   
		   
	   }



   }
}

?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">

    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
	<title>Untitled Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="stylesheet" href="Cadastro.css">
		<script src="https://kit.fontawesome.com/3862e9d2b8.js" crossorigin="anonymous"></script>
</head>

<body>
		<div class="dark-light-mode">
			<input type="checkbox" id="switch" style="display: none; float: right;">
			<label for="switch" style="cursor: pointer;" id="switchLabel">
				<i class="fa-regular fa-moon" style="color: #899095;"></i>
			</label>
		</div>

	
	
	<div class="login-box" style="display:flex; flex-direction:column;">
		<div class="item1"><h1 style="text-align:center;">Cadastre uma nova Conta</h1></div>
		
	  <form action="" method="POST" autocomplete="off" style=" margin:0 auto;">	
	
        <input type="text" name="nome" placeholder="Nome" 	<?php if(isset($_POST['nome'])) { echo 'Value = "' . $_POST['nome'] . '"'; } ?>/>
     
        <input type="email" name="email" placeholder="Email"  <?php if(isset($_POST['email'])) { echo 'Value = "' . $_POST['email'] . '"'; } ?>/>
  
        <input type="password"  name="senha" placeholder="Senha" minlength="8"/>

        <input type="password"  name="confirma" placeholder="Confirme a senha" minlength="8" />
		<br>
		<p>A senha deve conter no minimo 8 caracteres.</p>
		<br>
		<button type="submit">Enviar</button>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p class="p14">
      	Já possui uma Conta? <a style=" font-family: Arial, Helvetica, sans-serif;" href="Login.php">Acesse sua Conta aqui!</a>
    	</p>
      </form>
	</div>
	<script src="index.js"></script>
</body>
</html>