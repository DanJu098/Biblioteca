<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
?>
    <script>alert("Preencha seu email")</script>
<?php
    } else if(strlen($_POST['senha']) == 0) {
?>
    <script>alert("Preencha sua senha")</script>
<?php
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code2 = "SELECT * FROM tbperfil";
        $sql_code = "SELECT * FROM tbfuncionario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $sql_code3 = "SELECT * FROM tbusuario WHERE login = '$email' AND senha = '$senha'";
        $sql_query2 = $mysqli->query($sql_code3) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;
        $quantidade2 = $sql_query2->num_rows;

        

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['codigo'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['perfil'] = $usuario['perfil'];


            header("Location: validacao.php");

        } else if($quantidade2 == 1) {
            
            $usuario = $sql_query2->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['codigo'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['perfil'] = $usuario['perfil'];


            header('Location: validacao.php');

        } else {
            ?>
            <script>alert("Falha ao logar! E-mail ou senha incorretos")</script>
        <?php
        }

    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body><div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="POST" action="">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="email" class="login__input" placeholder="Email">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="senha" class="login__input" placeholder="Senha">
				</div>
				<input type="submit" value="Entrar" class="button login__submit">
			</form>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>