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
	    <link rel="stylesheet" href="Cadastro.css">
</head>

<body>
	<div class="box">
		<div style="position:absolute" class="item1"><h1>Cadastre uma nova Conta</h1></div>
		<div class="item2">
		<input class="cb-input" type="checkbox" id="switch"><label class="cb-label" for="switch">Toggle</label>
		<div class="moon"><div class="gg-sun"></div></div>
		</div>
	</div>
		
	
	<div class="login-box">
		
	  <form action="" method="POST">	
	
        <input type="text" name="nome" placeholder="Nome" 	<?php if(isset($_POST['nome'])) { echo 'Value = "' . $_POST['nome'] . '"'; } ?>/>
     
        <input type="text" name="email" placeholder="Email"  <?php if(isset($_POST['email'])) { echo 'Value = "' . $_POST['email'] . '"'; } ?>/>
  
        <input type="password"  name="senha" placeholder="Senha" />

        <input type="password"  name="confirma" placeholder="Confirme a senha" />
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