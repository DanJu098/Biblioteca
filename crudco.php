<?php
include_once('protect1.php');
include_once('conexao.php');
include_once 'functions.php';

$bn_busca1 = $mysqli->query("SELECT * FROM tbestoque") or die($mysqli->error);

$bn_busca2 = $mysqli->query("SELECT * FROM tblivro") or die($mysqli->error);


if($_SESSION['valor']==1){
    ?>
    <script>alert('Aluno já tem 2 livros alugados!')</script>
    <?php
    $_SESSION['valor']=0;
}

    while($arquivo = $bn_busca2->fetch_assoc()){ 
        $cod_livro = $arquivo['codigo'];
        $ad_busca1 = $mysqli->query("SELECT * FROM tbestoque WHERE codigolivro = $cod_livro") or die($mysqli->error);
        $arquivo3 = $ad_busca1->fetch_assoc();

        ?>
            <form action="aluguel.php" method="post"  class="banner">
                <img src="<?php echo $arquivo['caminho']; ?>" width="220px" height="300px">
                <br><br>
                <label><?php echo $arquivo['titulo']; ?></label><br>
                <label><?php echo "Quantidade: " . $arquivo3['qtdeAtual']; ?></label><br>
                <label><?php echo "Código do livro: " . $arquivo3['codigolivro']; ?></label>
                <br>
                <input type="hidden" value="<?php echo $cod_livro; ?>" name="cod_livro">

                <label><?php echo "Digite o código do aluno: "?></label>
                <input type="text" name ="Cod_Aluno">
                <br><br>
                <input type="submit" name="Pegar" value="Alugar"/>
            </form>
        <?php
        } 
        ?>
<a href="funcionario.php">Voltar</a>
<br><br>
<a href="Sair.php">Sair</a>
<br><br>
<a href="Devolver.php">Devolver</a>