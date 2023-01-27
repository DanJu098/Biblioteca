<?php
    include_once('protect1.php');
    include_once('conexao.php');
    include_once 'functions.php';


    $cargo = $_SESSION['perfil'];

//CADASTRAR
    if(isset($_POST["cadastrar1"])){
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $periodo = $_POST['periodo'];
    $senha = $_POST['senha'];
    $funcao = $_POST['funcao'];

    cad_fun($nome,$tel,$email,$periodo,$senha,$funcao);
    header('Location: crudfun.php');
    }

//ALTERAR
    if(isset($_POST["alterar"])){
        $cod = $_POST['cod'];
        $nome = $_POST['nome'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $periodo = $_POST['periodo'];
        $senha = $_POST['senha'];
        $funcao = $_POST['funcao'];

        alter_Fun($cod,$nome,$tel,$email,$periodo,$senha,$funcao);
        header('Location: crudfun.php');
    }

//EXCLUIR
    if(isset($_POST["excluir1"])){
        $cod = $_POST['cod'];
    
        exc_Fun($cod);
        
        header('Location: crudfun.php');
    }
?>




<?php
    if($cargo==1){
?>
<form action="" method="POST">
    <input type="submit" value="Cadastrar " name="cdt1">
    <input type="submit" value="Alterar" name="alter1">
    <input type="submit" value="Excluir" name="exc1">
    <input type="submit" value="Visualizar" name="vis1">
</form>
<?php
    }
?>

<!--CADASTRAR-->
<?php

if(isset($_POST['cdt1'])){

?>
 <br/><br/>
            <form action="" method="POST">
                <label for="nome">Nome: </label>
                <input type="text" name="nome" required> &nbsp;&nbsp;&nbsp;
                <label for="tel">Telefone: </label>
                <input type="tel" name="tel" maxlength="15" required><br/><br/>
                <label for="email">Email: </label>
                <input type="text" name="email" required>&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="periodo">Período: </label>
                <select name="periodo" required>
                    <option value=""></option>
                    <option value="M">Manhã</option>
                    <option value="T">Tarde</option>
                    <option value="N">Noite</option>
                </select><br/><br/>
                <label for="senha">Senha: </label>
                <input type="input" name='senha' required>&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="funcao">Função: </label>
                <select name="funcao" required>
                    <option value=""></option>
                    <option value="1">Master</option>
                    <option value="2">Funcionário</option>
                </select><br/>
                <br/><br/>
                <input type="submit" value="Confirmar cadastro" name="cadastrar1"><br/><br/>
            </form>
           
            <?php
}
?>

<!--BUSCA DO ALTERAR-->
<?php

if(isset($_POST['alter1'])){

?>

<br/><br/>
        <form action="" method="POST">
            <label for="email">Email: </label>
            <input type="text" name="email_a" required>
            <br/><br/>
            <input type="submit" value="Buscar" name="Buscar1"><br/><br/>
        </form>
<?php
}
        ?>

<!--ALTERAR-->

<?php
    if(isset($_POST["Buscar1"])){
        $email = $_POST['email_a'];     
        $bn_busca1 = $mysqli->query("SELECT * FROM tbfuncionario WHERE email = '$email'") or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if($quantidade == 1){
            $busca1 = $bn_busca1->fetch_assoc();
?>

        <br/><br/>
        <form action="" method="post">
            <label for="cod">Código: </label>
            <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required value="<?php echo $busca1['nome']; ?>"> &nbsp;&nbsp;&nbsp;
            <label for="tel">Telefone: </label>
            <input type="tel" name="tel" maxlength="11" value="<?php echo $busca1['fone']; ?>"  required><br/><br/>
            <label for="email">Email: </label>
            <input type="text" name="email" value="<?php echo $busca1['email']; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="periodo">Período: </label>
            <select name="periodo" required>
                <option value=""><?php echo $busca1['periodo']; ?></option>
                <option value="M">Manhã</option>
                <option value="T">Tarde</option>
                <option value="N">Noite</option>
            </select><br/><br/>
            <label for="senha">Senha: </label>
            <input type="input" name='senha' value="<?php echo $busca1['senha']; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="funcao">Função: </label>
            <select name="funcao"  required>
                <option value=""><?php echo $busca1['perfil']; ?></option>
                <option value="1">Master</option>
                <option value="2">Funcionário</option>
            </select><br/>
            <br/><br/>
            <input type="submit" value="Alterar" name="alterar"><br/><br/>
        </form>
    <?php
    }}
    ?>

<!--EXCLUIR-->
<?php
if(isset($_POST["exc1"])){
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

<!--FORMULÁRIO DE EXCLUSÃO DO FUNCIONÁRIO-->
<?php
if(isset($_POST["buscarEXC"])){
    $email_d = $_POST['email_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tbfuncionario WHERE email = '$email_d'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
        $busca1 = $bn_busca1->fetch_assoc();

    ?>
        <br/><br/>
        <form action="" method="post">
            <label for="cod">Código: </label>
            <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required value="<?php echo $busca1['nome']; ?>" readonly> &nbsp;&nbsp;&nbsp;
            <label for="tel">Telefone: </label>
            <input type="tel" name="tel" maxlength="11" value="<?php echo $busca1['fone']; ?>"  required readonly><br/><br/>
            <label for="email">Email: </label>
            <input type="text" name="email" value="<?php echo $busca1['email']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="periodo">Período: </label>
            <select name="periodo" required readonly>
                <option value="<?php echo $busca1['periodo']; ?>"><?php echo $busca1['periodo']; ?></option>
            </select><br/><br/>
            <label for="senha">Senha: </label>
            <input type="input" name='senha' value="<?php echo $busca1['senha']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="funcao">Função: </label>
            <select name="funcao" required readonly>
                <option value="<?php echo $busca1['perfil']; ?>"><?php echo $busca1['perfil']; ?></option>
            </select><br/>
            <br/><br/>
            <input type="submit" value="Excluir" name="excluir1"><br/><br/>
        </form>
    <?php
    }}else{
        
    }
    ?>

<!--VISUALIZAR-->
<?php
    if(isset($_POST["vis1"])){
    
        $ab_busca1 = $mysqli->query("SELECT * FROM tbfuncionario") or die($mysqli->error);

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
                <th>Período</th>
                <th>Senha</th>
                <th>Perfil</th>
                <tbody>
                <?php
                while($arquivo = $ab_busca1->fetch_assoc()){ 
                ?>
                    <tr>
                        <td><?php echo $arquivo['codigo']; ?></td>
                        <td><?php echo $arquivo['nome']; ?></td>
                        <td><?php echo $arquivo['fone']; ?></td>
                        <td><?php echo $arquivo['email']; ?></td>
                        <td><?php echo $arquivo['periodo']; ?></td>
                        <td><?php echo $arquivo['senha']; ?></td>
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

<!--FORMULÁRIO DE VISUALIZAR DO FUNCIONÁRIO-->
<?php
if(isset($_POST["buscarVIS"])){
    $email_d = $_POST['email_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tbfuncionario WHERE email = '$email_d'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
        $busca1 = $bn_busca1->fetch_assoc();

    ?>
        <br/><br/>
        <form action="" method="post">
            <label for="cod">Código: </label>
            <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required value="<?php echo $busca1['nome']; ?>" readonly> &nbsp;&nbsp;&nbsp;
            <label for="tel">Telefone: </label>
            <input type="tel" name="tel" maxlength="11" value="<?php echo $busca1['fone']; ?>"  required readonly><br/><br/>
            <label for="email">Email: </label>
            <input type="text" name="email" value="<?php echo $busca1['email']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="periodo">Período: </label>
            <select name="periodo" required readonly>
                <option value="<?php echo $busca1['periodo']; ?>"><?php echo $busca1['periodo']; ?></option>
            </select><br/><br/>
            <label for="senha">Senha: </label>
            <input type="input" name='senha' value="<?php echo $busca1['senha']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="funcao">Função: </label>
            <select name="funcao" required readonly>
                <option value="<?php echo $busca1['perfil']; ?>" readonly><?php echo $busca1['perfil']; ?></option>
            </select><br/>
            <br/><br/>
        </form>
    <?php
    }}else{
        
    }
    ?>
<a href="funcionario.php">Voltar</a>
<br><br>
<a href="Sair.php">Sair</a>