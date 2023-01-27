<?php
$server = "localhost:3306";
$user = "root";
$password = "root";
$dbname = "biblioteca";
$mysqli = mysqli_connect($server,$user,$password,$dbname);

function cad_Fun($a,$b,$c,$d,$e,$f){
    global $mysqli;
    $res = mysqli_query($mysqli,"INSERT INTO tbfuncionario(nome, fone, email, periodo, senha, perfil) VALUES('$a','$b','$c','$d','$e',$f)"); 
    mysqli_close($mysqli);
    }
    
    function cad_Clie($a,$b,$c,$d,$e){
    global $mysqli;
    $res = mysqli_query($mysqli,"INSERT INTO tbusuario(nome, fone, email, senha, qtdLivro, endereco, perfil) VALUES('$a','$b','$c','$d', 0,'$e',3)"); 
    mysqli_close($mysqli);
    }
    
    function cadLivro($a,$b,$c,$d,$e,$f,$g){
        global $mysqli;
        $res = mysqli_query($mysqli,"INSERT INTO tblivro(titulo, autor, genero, editora, isbn, paginas, caminho) VALUES('$a','$b',$c,'$d',$e,$f,'$g')"); 
        mysqli_close($mysqli);
    }
    
    function cad_QTDE($a,$b,$c){
        global $mysqli;
        $res = mysqli_query($mysqli,"INSERT INTO tbestoque(codigolivro, qtde, qtdeAtual) VALUES($c,$a,$b)"); 
        mysqli_close($mysqli);
    }

    function alter_Fun($cod,$a,$b,$c,$d,$e,$f){
        global $mysqli;
        $res = mysqli_query($mysqli,"UPDATE tbfuncionario SET nome = '$a', fone = $b, email = '$c', periodo = '$d', senha = '$e', perfil = $f WHERE codigo = $cod"); 
        mysqli_close($mysqli);
    }

    function alter_Clie($cod,$a,$b,$c,$d,$e){
        global $mysqli;
        $res = mysqli_query($mysqli,"UPDATE tbusuario SET nome = '$a', fone = $b, email = '$c', senha = '$d',  endereco = '$e' WHERE codigo = $cod"); 
        mysqli_close($mysqli);
    }
    
    function alter_Estoque($cod,$a,$b,$c,$d,$e){
        global $mysqli;
        $res = mysqli_query($mysqli,"UPDATE tbcliente SET nome = '$a', fone = $b, email = '$c', senha = '$d',  endereco = '$e' WHERE cod = $cod"); 
        mysqli_close($mysqli);
    }
    
    function alter_Livroft($cod,$a){
        global $mysqli;
            $sql_query = $mysqli->query("SELECT * FROM tblivro WHERE codigo = $cod") or die($mysqli->error);
            $arquivo = $sql_query->fetch_assoc();
            $imagem = $arquivo['caminho'];
            unlink($imagem);
            $res = mysqli_query($mysqli,"UPDATE tblivro SET caminho = '$a' WHERE codigo = $cod"); 
        mysqli_close($mysqli);
    }
    
    function alter_Livrocp($cod,$a,$b,$c,$d,$e,$g){
        global $mysqli;
            $res = mysqli_query($mysqli,"UPDATE tblivro SET titulo = '$a', autor = '$b', genero = $c, editora = '$d', isbn = $e, paginas = $g WHERE codigo = $cod"); 
        mysqli_close($mysqli);
    }
    
    function alter_QTDE($cod,$a,$b,$c){
        global $mysqli;
        $res = mysqli_query($mysqli,"UPDATE tbestoque SET codigolivro = '$a', qtde = $b, qtdeAtual = '$c' WHERE codigo = $cod"); 
        mysqli_close($mysqli);
    }
    
    function exc_Fun($cod){
        global $mysqli;
        $res = mysqli_query($mysqli,"DELETE FROM tbfuncionario WHERE codigo = $cod"); 
    
        mysqli_close($mysqli);
    }
    
    function exc_Clie($cod){
        global $mysqli;
        $res = mysqli_query($mysqli,"DELETE FROM tbusuario WHERE codigo = $cod"); 
    
        mysqli_close($mysqli);
    }
    
    function exc_Livro($cod){
        global $mysqli;
        $res = mysqli_query($mysqli,"DELETE FROM tblivro WHERE codigo = $cod"); 
        mysqli_close($mysqli);
    }
    
    function exc_QTDE($cod){
        global $mysqli;
        $res = mysqli_query($mysqli,"DELETE FROM tbestoque WHERE codigo = $cod"); 
        mysqli_close($mysqli);
    }
    
    function cmd($a,$b){
        global $mysqli;
        $res = mysqli_query($mysqli,"INSERT INTO tbcomanda(cod_clie, cod_livro, dt_dev, multa) VALUES($a,$b,DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 10 DAY), 10)"); 
        $res2 = mysqli_query($mysqli,"UPDATE tbestoque SET qtde_atual = qtde_atual - 1 WHERE cod_livro = $b");
        $res3 = mysqli_query($mysqli,"UPDATE tbcliente SET qtde_livro = 1 WHERE cod = $a"); 
        mysqli_close($mysqli);
    }
    
    function cmd_dev($a,$b){
        global $mysqli;
        $res = mysqli_query($mysqli,"DELETE FROM tbcomanda  WHERE cod_clie = $a && cod_livro = $b"); 
        $res2 = mysqli_query($mysqli,"UPDATE tbestoque SET qtde_atual = qtde_atual + 1 WHERE cod_livro = $b");
        $res3 = mysqli_query($mysqli,"UPDATE tbcliente SET qtde_livro = 0 WHERE cod = $a"); 
        mysqli_close($mysqli);
    }

    function aluga($a, $b){
        global $mysqli;
        $res = mysqli_query($mysqli, "INSERT INTO comanda (codigocliente, codigolivro, datadevolucao, multa) VALUES ($a, $b, DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 7 DAY),10)");
         $re1 = mysqli_query($mysqli,"UPDATE tbestoque SET qtdeAtual = qtdeAtual-1 where codigolivro = '$b' ");
        $res2 = mysqli_query($mysqli,"UPDATE tbusuario SET qtdLivro = qtdLivro + 1 where codigo = '$a' "); 
    }

    function devolve($a, $b){
        global $mysqli;
        $res = mysqli_query($mysqli,"DELETE FROM comanda  WHERE codigocliente = $a && codigolivro = $b"); 
         $re1 = mysqli_query($mysqli,"UPDATE tbestoque SET qtdeAtual = qtdeAtual+1 where codigolivro = '$b' ");
        $res2 = mysqli_query($mysqli,"UPDATE tbusuario SET qtdLivro = 0 where codigo = '$a' "); 
    }