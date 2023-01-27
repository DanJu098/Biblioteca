<?php
include_once('protect1.php');
include_once('conexao.php');
include_once 'functions.php';

$cod_livro= $_POST['cod_livro'];
$cod_clie = $_POST['Cod_Aluno'];


$ress =  $mysqli->query("SELECT * FROM tbusuario WHERE codigo='$cod_clie'") or die($mysqli->error);
$resultado = $ress-> fetch_assoc();

$quantidade = $ress->num_rows;

if($resultado['qtdLivro'] == 2){
    $_SESSION["valor"]=1;
}

else if($quantidade == 0){
    echo "Aluno não cadastrado";
}

else{
    aluga($cod_clie, $cod_livro);
}


header('Location: crudco.php');
