<?php
include_once('protect1.php');
include_once('conexao.php');
include_once 'functions.php';



$ress =  $mysqli->query("SELECT * FROM comanda") or die($mysqli->error);
$quantidade = $ress->num_rows;
?>

<h1>Livro alugados</h1>
<?php
if($quantidade!=0){
while($resultado = $ress-> fetch_assoc()){ 

    $cod_livro = $resultado['codigolivro'];
    $cod_clie = $resultado['codigocliente'];
    $res =  $mysqli->query("SELECT * FROM tblivro WHERE codigo='$cod_livro'") or die($mysqli->error);
    $resultados = $res-> fetch_assoc();
    ?>
    
    <form action="Devolvemano.php" method="post"  class="banner">
                <img src="<?php echo $resultados['caminho']; ?>" width="220px" height="300px">
                <br>
                <label>Codigo do Livro:<?php echo $resultado['codigolivro'];?></label><br>
                <input type="hidden" value="<?php echo $cod_livro; ?>" name="cod_livro">
                <input type="hidden" value="<?php echo $cod_clie; ?>" name="cod_clie">
                <label>Nome do livro:<?php echo $resultados['titulo']; ?></label><br>
                <label>Codigo do Cliente<?php echo $resultado['codigocliente']; ?></label><br>
                <label>Data da devolução<?php echo $resultado['datadevolucao']; ?></label><br>
                <br><br>
                <input type="submit" name="devolver" value="Devolver">
            </form>

        <?php
        }}
        else{
            echo "NENHUM LIVRO FOI ALUGADO!";
        }
        ?>
<BR><BR>
<a href="crudco.php">Voltar</a>
<br><br>
<a href="Sair.php">Sair</a>
<br><br>