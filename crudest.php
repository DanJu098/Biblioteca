<?php
    include_once('protect1.php');
    include_once('conexao.php');
    include_once 'functions.php';

$cargo = $_SESSION['perfil'];

if(isset($_POST["cadastrar4"])){
// ------------------------------!!!!!CADASTRANDO ESTOQUE!!!!!--------------------------//
$cod = $_POST['cod'];
$qtde = $_POST['qtde'];

$ress =  $mysqli->query("SELECT * FROM tbestoque WHERE codigo='$cod'") or die($mysqli->error);
$resultado = $ress-> fetch_assoc();

$quantidade = $ress->num_rows;
if($quantidade==1){

}
else{     
cad_QTDE($qtde,$qtde,$cod);     
header('Location: crudest.php');
}
}



//--------ESSA SÃO AS VARIÁVEIS DO '$ARQUIVO' QUE ESTAVA DANDO PAU KK--------------------//
$sql_query = $mysqli->query("SELECT * FROM tblivro") or die($mysqli->error);
$sql_query2 = $mysqli->query("SELECT * FROM tbestoque") or die($mysqli->error);




if(isset($_POST["alterar4"])){
// ------------------------------!!!!!ALTERANDO ESTOQUE!!!!!----------------------------//
$cod = $_POST['cod'];
$cod_livro = $_POST['cod_livro'];
$qtde = $_POST['qtde'];
$qtde_atual = $_POST['qtde_atual'];
                
alter_QTDE($cod,$cod_livro,$qtde,$qtde_atual);
                
header('Location: crudest.php');
}


if(isset($_POST["excluir4"])){
// ------------------------------!!!!!EXCLUIR ESTOQUE!!!!!----------------------------//
$cod = $_POST['cod'];
exc_QTDE($cod);
                        
header('Location: crudest.php');
}
?>
<!---------------INICIO DO FORM--------------------------->
<!---------------INICIO DO FORM--------------------------->
<!---------------INICIO DO FORM--------------------------->
<!---------------INICIO DO FORM--------------------------->
<?php
    if($cargo == 1 ) {
?>  

<!-- -------------------------------------------!!!!FUNÇÕES QUE O MASTER PODE REALIZAR!!!!----------------------------------- -->
<form action="" method="POST">
     <input type="submit" value="Cadastrar" name="cdt4">
     <input type="submit" value="Alterar" name="alter4">
     <input type="submit" value="Excluir" name="exc4">
     <input type="submit" value="Visualizar" name="vis4">
</form>

<?php
} else {
?>

<!-- -------------------------------------------!!!!FUNÇÕES QUE O FUNCIONÁRIO COMUM PODE REALIZAR!!!!----------------------------------- -->
<form action="" method="POST">
    <input type="submit" value="Cadastrar" name="cdt4">
    <input type="submit" value="Alterar" name="alter4">
    <input type="submit" value="Visualizar" name="vis4">
</form>
<?php
}
?>
<br/><br/>


<!--AQUI COMEÇAM AS FUNÇÕES-->
<!--AQUI COMEÇAM AS FUNÇÕES-->
<!--AQUI COMEÇAM AS FUNÇÕES-->
<!--AQUI COMEÇAM AS FUNÇÕES-->


<?php
if(isset($_POST["cdt4"]))
{
?>
<!-- -------------------------------------------!!!!CADASTRO DO ESTOQUE!!!!----------------------------------- -->
<br/><br/>
<form action="" method="post">
    <label for="cod">Código: </label>
    <input type="tel" name="cod" maxlength="3" required><br/><br/>
    <label for="qtde">Quantidade: </label>
    <input type="number" name="qtde" maxlength="10" required>
<br/><br/>
    <input type="submit" value="Cadastrar" name="cadastrar4"><br/><br/>
</form>


<table border="1" cellpadding="10" class="consulta">
    <thead>
        <th>Código</th>
        <th>Nome</th>
    <tbody>

<?php
while($arquivo = $sql_query->fetch_assoc()){ 
?>
    <tr>
        <td><?php echo $arquivo['codigo']; ?></td>
        <td><?php echo $arquivo['titulo']; ?></td>
    </tr>
<?php
} 
?>
    </tbody>
    </thead>
</table>


<table border="1" cellpadding="10" class="consulta">
    <thead>
        <th>Código do Livro</th>
        <th>Quantidade</th>
        <th>Quantidade Atual</th>
            <tbody>
                <?php
                while($arquivo2 = $sql_query2->fetch_assoc()){ 
                ?>
                <tr>
                    <td><?php echo $arquivo2['codigolivro']; ?></td>
                    <td><?php echo $arquivo2['qtde']; ?></td>
                    <td><?php echo $arquivo2['qtdeAtual']; ?></td>
                </tr>
                <?php
                } 
                ?>
            </tbody>
    </thead>
</table>

<?php 
}else{
?>

<?php
}
?>


     <!-- -------------------------------------------!!!!ALTERAÇÃO DO ESTOQUE!!!!----------------------------------- -->


<?php
if(isset($_POST["alter4"])){
    ?>
        <br/><br/>
        <form action="" method="post">
            <label for="cod_b">Código do livro: </label>
            <input type="text" name="cod_b" required>
            <br/><br/>
            <input type="submit" value="Buscar" name="Buscar4"><br/><br/>
        </form>

        <table border="1" cellpadding="10" class="consulta">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <tbody>
                    <?php
                    while($arquivo = $sql_query->fetch_assoc()){ 
                    ?>
                        <tr>
                            <td><?php echo $arquivo['codigo']; ?></td>
                            <td><?php echo $arquivo['titulo']; ?></td>
                        </tr>
                    <?php
                    } 
                    ?>
                    </tbody>
                </thead>
            </table>

            <table border="1" cellpadding="10" class="consulta">
                <thead>
                    <th>Código do Livro</th>
                    <th>Quantidade</th>
                    <th>Quantidade Atual</th>
                    <tbody>
                    <?php
                    while($arquivo2 = $sql_query2->fetch_assoc()){ 
                    ?>
                        <tr>
                            <td><?php echo $arquivo2['codigolivro']; ?></td>
                            <td><?php echo $arquivo2['qtde']; ?></td>
                            <td><?php echo $arquivo2['qtdeAtual']; ?></td>
                        </tr>
                    <?php
                    } 
                    ?>
                    </tbody>
                </thead>
            </table>
    <?php
        }else{
    ?>

    <?php
        }
?>



 <!-- -------------------------------------------!!!!EXCLUSÃO DO ESTOQUE!!!!----------------------------------- -->


<?php
if(isset($_POST["exc4"])){
?>
    <br/><br/>
    <h1>Digite aqui o código do livro que deseja excluir o ESTOQUE:</h1>
    <form action="" method="post">
        <label for="cod_d">Código do livro: </label>
        <input type="text" name="cod_d" required>
        <br/><br/>
        <input type="submit" value="Buscar" name="buscar44"><br/><br/>
    </form>

    <h1>Livros:</h1>

    <table border="1" cellpadding="10" class="consulta">
            <thead>
                <th>Código</th>
                <th>Nome</th>
                <tbody>
                <?php
                while($arquivo = $sql_query->fetch_assoc()){ 
                ?>
                    <tr>
                        <td><?php echo $arquivo['codigo']; ?></td>
                        <td><?php echo $arquivo['titulo']; ?></td>
                    </tr>
                <?php
                } 
                ?>
                </tbody>
            </thead>
        </table>
        <h1>Estoque:</h1>
        <table border="1" cellpadding="10" class="consulta">
            <thead>
                <th>Código do Livro</th>
                <th>Quantidade</th>
                <th>Quantidade Atual</th>
                <tbody>
                <?php
                while($arquivo2 = $sql_query2->fetch_assoc()){ 
                ?>
                    <tr>
                        <td><?php echo $arquivo2['codigolivro']; ?></td>
                        <td><?php echo $arquivo2['qtde']; ?></td>
                        <td><?php echo $arquivo2['qtdeAtual']; ?></td>
                    </tr>
                <?php
                } 
                ?>
                </tbody>
            </thead>
        </table>
        <?php
    }else{
?>

<?php
    }
?>





 <!-- -------------------------------------------!!!!BUSCA DO ESTOQUE!!!!----------------------------------- -->




<?php
if(isset($_POST["vis4"])){
?>
    <br/><br/>
    <h1>Livros cadastrados: </h1>
    <table border="1" cellpadding="10" class="consulta">
        <thead>
            <th>Código do livro</th>
            <th>Nome do livro</th>
            <tbody>
            <?php
            while($arquivo = $sql_query->fetch_assoc()){ 
            ?>
                <tr>
                    <td><?php echo $arquivo['codigo']; ?></td>
                    <td><?php echo $arquivo['titulo']; ?></td>
                </tr>
            <?php
            } 
            ?>
            </tbody>
        </thead>
    </table>
<h1>Livros cadastrados no estoque: </h1>
        <table border="1" cellpadding="10" class="consulta">
            <thead>
                <th>Código do Livro</th>
                <th>Quantidade</th>
                <th>Quantidade Atual</th>
                <tbody>
                <?php
                while($arquivo2 = $sql_query2->fetch_assoc()){ 
                ?>
                    <tr>
                        <td><?php echo $arquivo2['codigolivro']; ?></td>
                        <td><?php echo $arquivo2['qtde']; ?></td>
                        <td><?php echo $arquivo2['qtdeAtual']; ?></td>
                    </tr>
                <?php
                } 
                ?>
                </tbody>
            </thead>
        </table>
<?php
    }else{
?>

<?php
    }
?>


<!--!!! OS ELEMENTOS DO FORM ACABAM AQUI !!!-->
<!--!!! OS ELEMENTOS DO FORM ACABAM AQUI !!!-->
<!--!!! OS ELEMENTOS DO FORM ACABAM AQUI !!!-->
<!--!!! OS ELEMENTOS DO FORM ACABAM AQUI !!!-->



<!--!!AQUI COMEÇAM AS FUNÇÕES DOS SUBMITS!!-->


<?php
if(isset($_POST["buscar44"])){
// -------------------------------------------!!!!FORMULÁRIO DE EXCLUSÃO DO ESTOQUE!!!!----------------------------------- //

    $cod_livrod = $_POST['cod_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tbestoque WHERE codigolivro = '$cod_livrod'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
    $busca1 = $bn_busca1->fetch_assoc();
?>
        <br/><br/>
        <form action="" method="post">
            <label for="cod">Código do Estoque: </label>
            <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
            <label for="cod_livro">Código do livro: </label>
            <input type="number" name="cod_livro" maxlength="5" value="<?php echo $busca1['codigolivro']; ?>" required readonly><br/><br/>
            <label for="qtde">Quantidade Total: </label>
            <input type="number" name="qtde" maxlength="11" value="<?php echo $busca1['qtde']; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
            <label for="qtde_atual">Quantidade Atual: </label>
            <input type="number" name="qtde_atual" maxlength="11" value="<?php echo $busca1['qtdeAtual']; ?>" required readonly>
            <br/><br/>
            <input type="submit" value="Excluir" name="excluir4"><br/><br/>
        </form>

        <table border="1" cellpadding="10" class="consulta">
            <thead>
                <th>Código</th>
                <th>Nome</th>
                <tbody>
                <?php
                while($arquivo = $sql_query->fetch_assoc()){ 
                ?>
                    <tr>
                        <td><?php echo $arquivo['codigo']; ?></td>
                        <td><?php echo $arquivo['titulo']; ?></td>
                    </tr>
                <?php
                } 
                ?>
                </tbody>
            </thead>
        </table>
    <?php
    }else{
        
    }
    ?>
<?php
    }else{
    }
?>



<?php
    if(isset($_POST["Buscar4"])){
// -------------------------------------------!!!!FORMULÁRIO DE ALTERAÇÃO DO ESTOQUE!!!!----------------------------------- //

        $cod_livro = $_POST['cod_b'];     
        $bn_busca1 = $mysqli->query("SELECT * FROM tbestoque WHERE codigolivro = '$cod_livro'") or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if($quantidade == 1){
        $busca1 = $bn_busca1->fetch_assoc();
    ?>
            <br/><br/>
            <form action="" method="post">
                <label for="cod">Código do Estoque: </label>
                <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
                <label for="cod_livro">Código do livro: </label>
                <input type="number" name="cod_livro" maxlength="5" value="<?php echo $busca1['codigolivro']; ?>" required><br/><br/>
                <label for="qtde">Quantidade Total: </label>
                <input type="number" name="qtde" maxlength="11" value="<?php echo $busca1['qtde']; ?>" required> &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="qtde_atual">Quantidade Atual: </label>
                <input type="number" name="qtde_atual" maxlength="11" value="<?php echo $busca1['qtdeAtual']; ?>" required>
                <br/><br/>
                <input type="submit" value="Alterar" name="alterar4"><br/><br/>
            </form>

            <table border="1" cellpadding="10" class="consulta">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <tbody>
                    <?php
                    while($arquivo = $sql_query->fetch_assoc()){ 
                    ?>
                        <tr>
                            <td><?php echo $arquivo['codigo']; ?></td>
                            <td><?php echo $arquivo['titulo']; ?></td>
                        </tr>
                    <?php
                    } 
                    ?>
                    </tbody>
                </thead>
            </table>

            <table border="1" cellpadding="10" class="consulta">
                <thead>
                    <th>Código do Livro</th>
                    <th>Quantidade</th>
                    <th>Quantidade Atual</th>
                    <tbody>
                    <?php
                    while($arquivo2 = $sql_query2->fetch_assoc()){ 
                    ?>
                        <tr>
                            <td><?php echo $arquivo2['codigolivro']; ?></td>
                            <td><?php echo $arquivo2['qtde']; ?></td>
                            <td><?php echo $arquivo2['qtdeAtual']; ?></td>
                        </tr>
                    <?php
                    } 
                    ?>
                    </tbody>
                </thead>
            </table>
        <?php
        }else{
            
        }
        ?>
    <?php
        }else{
        }
    ?>


<?php
if(isset($_POST["buscar18"])){
// -------------------------------------------!!!!FORMULÁRIO DE VISUALIZAR DO ESTOQUE!!!!----------------------------------- //

    $cod_livrod = $_POST['cod_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tbestoque WHERE codigolivro = '$cod_livrod'") or die($mysqli->error);
    $bn_busca2 = $mysqli->query("SELECT * FROM tblivro WHERE codigo = '$cod_livrod'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
    $busca1 = $bn_busca1->fetch_assoc();
?>
        <br/><br/>
        <form action="" method="post">
            <label for="cod">Código do Estoque: </label>
            <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['cod']; ?>" required readonly><br/><br/>
            <label for="cod_livro">Código do livro: </label>
            <input type="number" name="cod_livro" maxlength="5" value="<?php echo $busca1['cod_livro']; ?>" required readonly><br/><br/>
            <label for="qtde">Quantidade Total: </label>
            <input type="number" name="qtde" maxlength="11" value="<?php echo $busca1['qtde']; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
            <label for="qtde_atual">Quantidade Atual: </label>
            <input type="number" name="qtde_atual" maxlength="11" value="<?php echo $busca1['qtde_atual']; ?>" required readonly>
            <br/><br/>
        </form>

        <table border="1" cellpadding="10" class="consulta">
            <thead>
                <th>Código</th>
                <th>Nome</th>
                <tbody>
                <?php
                $bn_busca22 = $bn_busca2->fetch_assoc()
                ?>
                    <tr>
                        <td><?php echo $bn_busca22['cod']; ?></td>
                        <td><?php echo $bn_busca22['nome']; ?></td>
                    </tr>
                </tbody>
            </thead>
        </table>
    <?php
    }else{
        
    }
    ?>
<?php
    }else{
    }
?>
<a href="funcionario.php">Voltar</a>
<br><br>
<a href="Sair.php">Sair</a>