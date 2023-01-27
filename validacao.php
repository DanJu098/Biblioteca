<?php

include('protect1.php');
include('conexao.php');



$cargo = $_SESSION['perfil'];

if($cargo == 1){
    header('Location: funcionario.php');
}else if($cargo == 2){
    header('Location: funcionario.php');
}else if($cargo == 3){
    header('Location: aluno.php');
}else{
    header('Location: index.php');
}
?>