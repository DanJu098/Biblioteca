<?php
    include_once('protect1.php');
    include_once('conexao.php');
    include_once 'functions.php';

    $cargo = $_SESSION['perfil'];

    //CADASTRAR
    if(isset($_POST["cadastrar2"])){
        $nome = $_POST['nome'];
        $tel = $_POST['number'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $end = $_POST['end'];
        
        cad_Clie($nome,$tel,$email,$senha,$end);
        
        header('Location: crudclie.php');
    }

    //ALTERAR
    if(isset($_POST["alterar2"])){
        $cod = $_POST['cod'];
        $nome = $_POST['nome'];
        $tel = $_POST['number'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $end = $_POST['end'];
        
        alter_Clie($cod,$nome,$tel,$email,$senha,$end);
        
        header('Location: crudclie.php');
    }

    //EXCLUIR
    if(isset($_POST["excluir2"])){
        $cod = $_POST['cod'];
        
        exc_Clie($cod);
        
        header('Location: crudclie.php');
    }
?>

<!--SE FOR PDM-->
<?php
    if($cargo==1){
?>
<form action="" method="POST">
    <input type="submit" value="Cadastrar " name="cdt2">
    <input type="submit" value="Alterar" name="alter2">
    <input type="submit" value="Excluir" name="exc2">
    <input type="submit" value="Visualizar" name="vis2">
</form>

<!--SE FOR FUNCIONÁRIO PADRÃO-->
<?php
    }else {
?>
<form action="" method="POST">
    <input type="submit" value="Cadastrar" name="cdt2">
    <input type="submit" value="Alterar" name="alter2">
    <input type="submit" value="Visualizar" name="vis2">
</form>
<?php
    }
?>

<!--CADASTRAR-->
<?php
if(isset($_POST["cdt2"]))
    {
?>
<br/><br/>
<form action="" method="post">
    <label for="nome">Nome: </label>
    <input type="text" name="nome" required> &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="number">Telefone: </label>
    <input type="tel" name="number" maxlength="11" required><br/><br/>
    <label for="email">Email: </label>
    <input type="text" name="email" required>&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="senha">Senha: </label>
    <input type="input" name='senha' required><br/><br/>
    <label for="end">Endereço: </label>
    <input type="input" name='end' required>
    <br/><br/>
    <input type="submit" value="Confirmar cadastro" name="cadastrar2"><br/><br/>
</form>
<?php 
    }
?>

<!--BUSCA DO ALTERAR-->
<?php
    if(isset($_POST["alter2"])){
?>
<br/><br/>
<form action="" method="post">
    <label for="email_b">Email: </label>
    <input type="text" name="email_b" required>
    <br/><br/>
    <input type="submit" value="Buscar" name="Buscar2"><br/><br/>
</form>
<?php
    }
?>

<!--ALTERAR-->
<?php
    if(isset($_POST["Buscar2"])){
        $email = $_POST['email_b'];     
        $bn_busca1 = $mysqli->query("SELECT * FROM tbusuario WHERE email = '$email'") or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if($quantidade == 1){
        $busca1 = $bn_busca1->fetch_assoc();
?>
<br/><br/>
<form action="" method="post">
    <label for="cod">Código: </label>
    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
    <label for="nome">Nome: </label>
    <input type="text" name="nome" value="<?php echo $busca1['nome']; ?>" required> &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="number">Telefone: </label>
    <input type="tel" name="number" maxlength="11" value="<?php echo $busca1['fone']; ?>" required><br/><br/>
    <label for="email">Email: </label>
    <input type="text" name="email" value="<?php echo $busca1['email']; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="senha">Senha: </label>
    <input type="input" name='senha' value="<?php echo $busca1['senha']; ?>" required><br/><br/>
    <label for="end">Endereço: </label>
    <input type="input" name='end' value="<?php echo $busca1['endereco']; ?>" required>
    <br/><br/>
    <input type="submit" value="Alterar" name="alterar2"><br/><br/>
</form>
<?php
    }}
?>

<!--EXCLUIR-->
<?php
if(isset($_POST["exc2"])){
?>
    <br/><br/>
    <form action="" method="post">
        <label for="email_d">Email: </label>
        <input type="text" name="email_d" required>
        <br/><br/>
        <input type="submit" value="Buscar" name="buscarEXC"><br/><br/>
    </form>
<?php
    }
?>

<!--FORMULÁRIO DE EXCLUSÃO DO USUÁRIO-->
<?php
if(isset($_POST["buscarEXC"])){
    $email_d = $_POST['email_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tbusuario WHERE email = '$email_d'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
    $busca1 = $bn_busca1->fetch_assoc();
?>
        <br/><br/>
        <form action="" method="post">
            <label for="cod">Código: </label>
            <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" value="<?php echo $busca1['nome']; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
            <label for="number">Telefone: </label>
            <input type="tel" name="number" maxlength="11" value="<?php echo $busca1['fone']; ?>" required readonly><br/><br/>
            <label for="email">Email: </label>
            <input type="text" name="email" value="<?php echo $busca1['email']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="senha">Senha: </label>
            <input type="input" name='senha' value="<?php echo $busca1['senha']; ?>" required readonly><br/><br/>
            <label for="end">Endereço: </label>
            <input type="input" name='end' value="<?php echo $busca1['endereco']; ?>" required readonly>
            <br/><br/>
            <input type="submit" value="Excluir" name="excluir2"><br/><br/>
        </form>

    <?php
    }else{

    }
?>
<?php
    }
?>

<!--VISUALIZAR-->
<?php
    if(isset($_POST["vis2"])){
        $ab_busca2 = $mysqli->query("SELECT * FROM tbusuario") or die($mysqli->error);
?>
<br/><br/>
<form action="" method="post">
    <label for="email_d">Email: </label>
    <input type="text" name="email_d" required>
    <br/><br/>
    <input type="submit" value="Buscar" name="buscarVIS"><br/><br/>
</form>
<table border="1" cellpadding="10" class="consulta">
    <thead>
        <th>Código</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Senha</th>
        <th>Endereço</th>
        <th>Perfil</th>
        <tbody>
            <?php
                while($arquivo = $ab_busca2->fetch_assoc()){ 
            ?>
            <tr>
                <td><?php echo $arquivo['codigo']; ?></td>
                <td><?php echo $arquivo['nome']; ?></td>
                <td><?php echo $arquivo['fone']; ?></td>
                <td><?php echo $arquivo['email']; ?></td>
                <td><?php echo $arquivo['senha']; ?></td>
                <td><?php echo $arquivo['endereco']; ?></td>
                <td><?php echo $arquivo['perfil']; ?></td>
            </tr>
            <?php
                } 
            ?>
        </tbody>
    </thead>
</table><br/><br/>
<?php
    }
?>

<!--FORMULÁRIO DE VISUALIZAR DO USUÁRIO-->
<?php
if(isset($_POST["buscarVIS"])){
    $email_d = $_POST['email_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tbusuario WHERE email = '$email_d'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
    $busca1 = $bn_busca1->fetch_assoc();
?>
<br/><br/>
<form action="" method="post">
    <label for="cod">Código: </label>
    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
    <label for="nome">Nome: </label>
    <input type="text" name="nome" value="<?php echo $busca1['nome']; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="number">Telefone: </label>
    <input type="tel" name="number" maxlength="11" value="<?php echo $busca1['fone']; ?>" required readonly><br/><br/>
    <label for="email">Email: </label>
    <input type="text" name="email" value="<?php echo $busca1['email']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="senha">Senha: </label>
    <input type="input" name='senha' value="<?php echo $busca1['senha']; ?>" required readonly><br/><br/>
    <label for="end">Endereço: </label>
    <input type="input" name='end' value="<?php echo $busca1['endereco']; ?>" required readonly>
    <br/><br/>
</form>
<?php
    }else{

    }}
?>
<a href="funcionario.php">Voltar</a>
<br><br>
<a href="Sair.php">Sair</a>