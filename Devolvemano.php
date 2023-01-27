<?php
include_once('protect1.php');
include_once('conexao.php');
include_once 'functions.php';


$cod_livro = $_POST['cod_livro'];
$cod_clie = $_POST['cod_clie'];

$ress =  $mysqli->query("SELECT * FROM tbusuario WHERE codigo='$cod_clie'") or die($mysqli->error);
$resultado = $ress-> fetch_assoc();

devolve($cod_clie, $cod_livro);



header('Location: Devolver.php');

