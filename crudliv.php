<?php
    include_once('protect1.php');
    include_once('conexao.php');
    include_once 'functions.php';


    $cargo = $_SESSION['perfil'];

//CADASTRAR
    if(isset($_POST["cadastrar3"])){
        if(isset($_FILES['arquivo'])){
            $arquivo = $_FILES['arquivo'];
        
            if($arquivo['error'])
                die("Falha ao enviar arquirvo" . $mysqli->error);
        
            if($arquivo['size'] > 2097152)
                die("Arquivo muito grande!!! Max: 2MB");
        
            $pasta = "Fotos_Livros/";
            $nomeDoArquivo = $arquivo['name'];
            $novoNomeDoArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
        
            if($extensao != "jpg" && $extensao != "png")
                die("Tipo de arquivo não aceito");
        
            $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        
            $deu_certo = move_uploaded_file($arquivo["tmp_name"],  $path);
            if($deu_certo){
                $nome = $_POST['nome'];
                $autor = $_POST['autor'];
                $genero = $_POST['genero'];
                $editora = $_POST['editora'];
                $isbn = $_POST['isbn'];
                $pag = $_POST['pag'];

                cadLivro($nome, $autor, $genero, $editora, $isbn, $pag, $path);

                header('Location: crudliv.php');
            }
            else{
                echo "<p>Falha ao enviar arquivo</p>";
            }
        }
    }

//ALTERAR FOTO
    if(isset($_POST["alterarft3"])){
        if(isset($_FILES['arquivo'])){
            $arquivo = $_FILES['arquivo'];

            if($arquivo['error'])
                die("Falha ao enviar arquirvo");

            if($arquivo['size'] > 2097152)
                die("Arquivo muito grande!!! Max: 2MB");

            $pasta = "Fotos_Livros/";
            $nomeDoArquivo = $arquivo['name'];
            $novoNomeDoArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

            if($extensao != "jpg" && $extensao != "png")
                die("Tipo de arquivo não aceito");

            $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

            $deu_certo = move_uploaded_file($arquivo["tmp_name"],  $path);
            if($deu_certo){
                $cod = $_POST['cod'];

                alter_Livroft($cod,$path);

                header('Location: crudliv.php');
            }
            else{
                echo "<p>Falha ao enviar arquivo</p>";
            }
        }
    }

//ALTERAR TEXTO
    if(isset($_POST["alterarcp3"])){
        $cod = $_POST['cod'];
        $nome = $_POST['nome'];
        $autor = $_POST['autor'];
        $genero = $_POST['genero'];
        $editora = $_POST['editora'];
        $isbn = $_POST['isbn'];
        $pag = $_POST['pag'];
    
        alter_Livrocp($cod,$nome, $autor, $genero, $editora, $isbn, $pag);
    
        header('Location: crudliv.php');
    
        }

//EXCLUIR
    if(isset($_POST["excluir3"])){
        $cod = $_POST['cod'];
        
        exc_Livro($cod);
        
        header('Location: crudliv.php');
    
    }
?>

<!--SE FOR PDM-->
<?php
    if($cargo == 1 ) {
?>
<form action="" method="POST">
    <input type="submit" value="Cadastrar" name="cdt3">
    <input type="submit" value="Alterar" name="alter3">
    <input type="submit" value="Excluir" name="exc3">
    <input type="submit" value="Visualizar" name="vis3">
</form>

<!--SE FOR FUNCIONÁRIO PADRÃO-->
<?php
    }else {
?>
<form action="" method="POST">
    <input type="submit" value="Cadastrar" name="cdt3">
    <input type="submit" value="Alterar" name="alter3">
    <input type="submit" value="Visualizar" name="vis3">
</form>
<?php
    }
?>

<!--CADASTRAR-->
<?php
    if(isset($_POST["cdt3"])){
?>
<br><br>
<form action="" enctype="multipart/form-data" method="post">
    <label class="picture" for="picture__input" tabIndex="0">
        <span class="picture__image"></span>
    </label>
    <input type="file" name="arquivo" id="picture__input">
    <script src="js/script.js"></script><br/><br/>
    <label for="nome">Nome: </label>
    <input type="text" name="nome" required> &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="autor">Autor: </label>
    <input type="text" name="autor" required><br/><br/>
    <label for="genero">Gênero: </label>
    <select name="genero" required>
        <option value=""></option>
        <option value="1">Terror</option>
        <option value="2">Mistério</option>
        <option value="3">Comédia</option>
        <option value="4">Drama</option>
        <option value="5">Romance</option>
        <option value="6">Aventura</option>
        <option value="7">Histórico</option>
        <option value="8">Biografia</option>
        <option value="9">Ação</option>
        <option value="10">Ficçao</option>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="editora">Editora: </label>
    <input type="text" name="editora" required><br/><br/>
    <label for="isbn">ISBN: </label>
    <input type="input" name='isbn' required>&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="pag">Página: </label>
    <input type="number" name='pag' required><br/><br/>
    <input type="submit" value="Cadastrar" name="cadastrar3"><br/><br/>
</form>
<?php
    }
?>

<!--ALTERAR-->
<?php
if(isset($_POST["Buscar3"])){
    $nome_b = $_POST['nome_b'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tblivro WHERE titulo = '$nome_b'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
    $busca1 = $bn_busca1->fetch_assoc();
?>
<br/><br/>
<form action="" enctype="multipart/form-data" method="post">
    <label class="picture" for="picture__input" tabIndex="0">
        <span class="picture__image"></span>
    </label>
    <input type="file" name="arquivo" id="picture__input">
    <script src="js/script.js"></script><br/><br/>
    <img src="<?php echo $busca1['caminho']; ?>" width="180px"><br/><br/>
    <label for="alterarcp3">Alterar a imagem: </label><br/>
    <input type="submit" value="Alterar" name="alterarft3"><br/><br/>

    <br/><br/>

    <form action="" enctype="multipart/form-data" method="post">
        <label for="cod">Código: </label>
        <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
        <label for="nome">Nome: </label>
        <input type="text" name="nome" value="<?php echo $busca1['titulo']; ?>" required> &nbsp;&nbsp;&nbsp;&nbsp;
        <label for="autor">Autor: </label>
        <input type="text" name="autor" value="<?php echo $busca1['autor']; ?>" required><br/><br/>
        <label for="genero">Gênero: </label>
        <select name="genero" required>
            <option value="<?php echo $busca1['genero']; ?>"><?php echo $busca1['genero']; ?></option>
            <option value="1">Terror</option>
            <option value="2">Mistério</option>
            <option value="3">Comédia</option>
            <option value="4">Drama</option>
            <option value="5">Romance</option>
            <option value="6">Aventura</option>
            <option value="7">Histórico</option>
            <option value="8">Biografia</option>
            <option value="9">Ação</option>
            <option value="10">Ficçao</option>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="editora">Editora: </label>
        <input type="text" name="editora" value="<?php echo $busca1['editora']; ?>" required><br/><br/>
        <label for="isbn">ISBN: </label>
        <input type="input" name='isbn' value="<?php echo $busca1['isbn']; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="pag">Página: </label>
        <input type="number" name='pag' value="<?php echo $busca1['paginas']; ?>" required><br/><br/>
        <label for="alterarcp3">Alterar os campos que são texto: </label><br/>
        <input type="submit" value="Alterar" name="alterarcp3"><br/><br/>
    </form>
        <?php
        }else{
            
        }
        ?>
    <?php
        }
    ?>

<!--EXCLUIR-->
<?php
    if(isset($_POST["exc3"])){
?>
<br/><br/>
<form action="" method="POST">
    <label for="nome_d">Nome: </label>
    <input type="text" name="nome_d" required>
    <br/><br/>
    <input type="submit" value="Buscar" name="buscar33">
</form>
<br/><br/>
<?php
    }
?>

<?php
if(isset($_POST["buscar33"])){
    $nome_d = $_POST['nome_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tblivro WHERE titulo = '$nome_d'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
    $busca1 = $bn_busca1->fetch_assoc();
?>
<br/><br/>
<form action="" enctype="multipart/form-data" method="post">
    <img src="<?php echo $busca1['caminho']; ?>" width="180px"><br/><br/>
    <label for="cod">Código: </label>
    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['codigo']; ?>" required readonly><br/><br/>
    <label for="nome">Nome: </label>
    <input type="text" name="nome" value="<?php echo $busca1['titulo']; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="autor">Autor: </label>
    <input type="text" name="autor" value="<?php echo $busca1['autor']; ?>" required readonly><br/><br/>
    <label for="genero">Gênero: </label>
    <select name="genero" required readonly>
        <option value="<?php echo $busca1['genero']; ?>"><?php echo $busca1['genero']; ?></option>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="editora">Editora: </label>
    <input type="text" name="editora" value="<?php echo $busca1['editora']; ?>" required readonly><br/><br/>
    <label for="isbn">ISBN: </label>
    <input type="input" name='isbn' value="<?php echo $busca1['isbn']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="pag">Página: </label>
    <input type="number" name='pag' value="<?php echo $busca1['paginas']; ?>" required readonly><br/><br/>
    <input type="submit" value="Excluir" name="excluir3"><br/><br/>
</form>

<?php
    }else{
        
    }}
?>

<!--VISUALIZAR-->
<?php
    if(isset($_POST["vis3"])){
    $ab_busca3 = $mysqli->query("SELECT * FROM tblivro") or die($mysqli->error);
?>
<br/><br/>
<form action="" method="POST">
    <label for="nome_d">Nome: </label>
    <input type="text" name="nome_d" required>
    <br/><br/>
    <input type="submit" value="Buscar" name="buscarLIV"><br/><br/>
</form>

<table border="1" cellpadding="10" class="consulta">
    <thead>
        <th>imagem</th>
        <th>Código</th>
        <th>Nome</th>
        <th>Autor</th>
        <th>Gênero</th>
        <th>Editora</th>
        <th>ISBN</th>
        <th>Páginas</th>
        <th>Caminho</th>
        <th>Data de Cadastro</th>
        <tbody>
        <?php
        while($arquivo = $ab_busca3->fetch_assoc()){ 
        ?>
            <tr>
                <td><img src="<?php echo $arquivo['caminho']; ?>" width="180px"></td>
                <td><?php echo $arquivo['codigo']; ?></td>
                <td><?php echo $arquivo['titulo']; ?></td>
                <td><?php echo $arquivo['autor']; ?></td>
                <td><?php echo $arquivo['genero']; ?></td>
                <td><?php echo $arquivo['editora']; ?></td>
                <td><?php echo $arquivo['isbn']; ?></td>
                <td><?php echo $arquivo['paginas']; ?></td>
                <td><?php echo $arquivo['caminho']; ?></td>
                <td><?php echo date("d/m/Y H:i", strtotime($arquivo['dt_cad'])); ?></td>
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
<?php
if(isset($_POST["alter3"])){
    ?>
        <br/><br/>
        <form action="" method="POST">
            <label for="nome_b">Nome: </label>
            <input type="text" name="nome_b" required>
            <br/><br/>
            <input type="submit" value="Buscar" name="Buscar3">
        </form>
        <br/><br/>
    <?php
}?>

<?php
if(isset($_POST["buscarLIV"])){
    $nome_d = $_POST['nome_d'];     
    $bn_busca1 = $mysqli->query("SELECT * FROM tblivro WHERE nome = '$nome_d'") or die($mysqli->error);

    $quantidade = $bn_busca1->num_rows;

    if($quantidade == 1){
    $busca1 = $bn_busca1->fetch_assoc();
?>
        <br/><br/>
        <form action="" enctype="multipart/form-data" method="post">
            <img src="<?php echo $busca1['caminho']; ?>" width="180px"><br/><br/>
            <label for="cod">Código: </label>
            <input type="number" name="cod" maxlength="5" value="<?php echo $busca1['cod']; ?>" required readonly><br/><br/>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" value="<?php echo $busca1['nome']; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
            <label for="autor">Autor: </label>
            <input type="text" name="autor" value="<?php echo $busca1['autor']; ?>" required readonly><br/><br/>
            <label for="genero">Gênero: </label>
            <select name="genero" required readonly>
                <option value="<?php echo $busca1['genero']; ?>"><?php echo $busca1['genero']; ?></option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="editora">Editora: </label>
            <input type="text" name="editora" value="<?php echo $busca1['editora']; ?>" required readonly><br/><br/>
            <label for="isbn">ISBN: </label>
            <input type="input" name='isbn' value="<?php echo $busca1['isbn']; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="pag">Página: </label>
            <input type="number" name='pag' value="<?php echo $busca1['pagina']; ?>" required readonly><br/><br/>
        </form>
    <?php
    }}else{
        
    }
    ?>
<a href="funcionario.php">Voltar</a>
<br><br>
<a href="Sair.php">Sair</a>