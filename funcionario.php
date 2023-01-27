<?php
include('Protect1.php');
include('Conexao.php');
include('functions.php');

$cargo = $_SESSION['perfil'];
?>

<?php
    if($cargo == 1 ) {
?>      
<!-- -------------------------------------------!!!!O QUE O PDM PODE CADASTRAR!!!!----------------------------------- -->
    <h1>Bem vindo ao seu menu principal!</h1>

    <div class="accordion">

        <!-- BOX 1 FUNCIONARIOS -->
        <div class="box a1" onclick="pg_crudfun()">
            <div class="image_1">
                <div class="text">
                    <h2>Funcionarios</h2>
                    <p>
                        Clique para entrar no CRUD dos funcionarios como um PDM
                    </p>
                </div>
            </div>
        </div>

        <!-- BOX 2 CLIENTES -->
        <div class="box a2" onclick="pg_crudclie()">
            <div class="image_2">
                <div class="text">
                    <h2>Clientes</h2>
                    <p>
                        Clique para entrar no CRUD dos clientes como um PDM
                    </p>
                </div>
            </div>
        </div>

        <!-- BOX 3 LIVROS -->
        <div class="box a3" onclick="pg_crudliv()">
            <div class="image_3">
                <div class="text">
                    <h2>Livros</h2>
                    <p>
                        Clique para entrar no CRUD dos livros como um PDM
                    </p>
                </div>
            </div>
        </div>

        <!-- BOX 4 ESTOQUE -->
        <div class="box a4" onclick="pg_crudest()">
            <div class="image_4">
                <div class="text">
                    <h2>Estoque</h2>
                    <p>
                        Clique para acessar os controles de estoque como um PDM
                    </p>
                </div>
            </div>
        </div>

        <!-- BOX 5 ESTOQUE -->
        <div class="box a5" onclick="pg_crudco()">
            <div class="image_5">
                <div class="text">
                    <h2>Comanda</h2>
                    <p>
                        Clique para acessar os controles da comanda como um PDM
                    </p>
                </div>
            </div>
        </div>

    </div>
            
    <?php
        } else {
    ?>
        <!-- -------------------------------------------!!!!O QUE O FUNCIONÁRIO COMUM PODE CADASTRAR!!!!----------------------------------- -->
            
            <a href="crudclie.php"><button>Cliente</button></a>
            <a href="crudliv.php"><button>Livro</button></a>
            <a href="crudest.php"><button>Estoque</button></a>
            
    <?php
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/funcionario.css">
    <script src="js/funcionario.js"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>


<br><br>
<center><button onclick="window.location.href = 'Sair.php'">Sair</button></center>