<!DOCTYPE html>
<?php
include("../conexao.php");
include("../banco/banco-usuario.php");
include("../banco/banco-produto.php");
include("../banco/banco-carrinho.php");

if (empty($_GET['idproduto'])) {
    header('location:index.php');
}

$idproduto = $_GET['idproduto'];
$lista = listaridProduto($conexao, $idproduto);

?>
<html>

<head>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <?php
    foreach ($lista as $produto) {
    ?>
        <title><?php echo $produto['tb_produto_nome'] ?></title>
    <?php
    }
    ?>
    <meta charset="UTF-8">
    <style>
        .imagem {
            width: 300px;
            height: 250px;
        }

        body {
            background-color: whitesmoke;
        }

        #barra {
            background-color: #ed620c;

        }


        .gallery-wrap .img-big-wrap img {
            margin-left: 9%;
            margin-top: 20%;
            height: 250px;
            width: auto;
            display: inline-block;
        }

        .gallery-wrap .img-small-wrap {
            text-align: center;
        }

        .gallery-wrap .img-small-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 4px;
            cursor: zoom-in;
        }

        a.nav-link:hover {
            color: AntiqueWhite !important;
        }

        a.nav-link {
            color: white !important;
        }

        button:hover {
            color: AntiqueWhite !important;
        }

        @media (max-width: 700px) {
            #logo {
                width: 0;
            }
        }
    </style>
    <meta content='width=device-width, initial-scale=0.9' name='viewport'>
    <title></title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="barra">
        <div class="container">
            <img id="logo" src="arquivos/MARKETOHOME Logo2.png" width=80 height=60>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <!--Barra de busca-->
            <form method="GET" style="width: 50%;margin-left: 5%;">
                <br>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="txtbusca" placeholder="Buscar Produtos" name="txtpesquisar" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-outline-light" value="Buscar" disabled>
                    </div>
                </div>
            </form>

            <div class="collapse navbar-collapse" id="navbarResponsive" style="padding-top: 2%;">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-link active">
                        <p>
                            <a class="nav-link" href="index.php"> Home</a>
                        </p>
                    </li>
                    <?Php
                    SESSION_start();
                    if (empty($_SESSION['login'])) {
                    ?>
                        <li class="nav-link active">
                            <p>
                                <a class="nav-link" href="login-cadastro/Cadastro.php">Criar Conta</a>
                            </p>
                        </li>

                        <li class="nav-link active">
                            <p>
                                <a class="nav-link" href="login-cadastro/Login.php">Entrar</a>
                            </p>
                        </li>
                        <?php
                    } else {
                        $clienteid = $_SESSION['nome'];
                        $listaclientesession = listarClienteid($conexao, $clienteid);

                        foreach ($listaclientesession as $cliente) {
                        ?>

                            <li class="nav-link active">
                                <p>
                                    <a class="nav-link" href="Carrinho.php">Carrinho (<?php echo ContarCarrinho($conexao, $clienteid);
                                                                                    } ?>)
                                    </a>
                                </p>
                            </li>

                            <li class="nav-link active">
                                <div class="btn-group">
                                    <button class="btn btn-primary dropdown-toggle" style="background-color: #ed620c;border-color:  #ed620c;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Minha Conta
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="Usuario/minhascompras.php">Compras</a>
                                        <a class="dropdown-item" href="Usuario/minhaconta.php">Meus Dados</a>
                                    </div>
                                </div>
                            </li>
                            </li>

                            <li class="nav-link active">
                                <p>
                                    <a class="nav-link" href="Logout.php"> Sair</a>
                                </p>
                            </li>
                        <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>

    <?php
    foreach ($lista as $produto) {
    ?>
        <div class="container">
            <div class="card">
                <div class="row">
                    <aside class="col-sm-5 border-right">
                        <article class="gallery-wrap">
                            <div class="img-big-wrap">
                                <img class="imagem" src="../Admin/Produto/imagens/<?php echo $produto['tb_imagens_prdt_imagem'] ?>">
                            </div> <!-- slider-product.// -->
                        </article> <!-- gallery-wrap .end// -->
                    </aside>
                    <aside class="col-sm-7">
                        <article class="card-body p-5">
                            <h3 class="title mb-3"><?php echo $produto['tb_produto_nome']; ?></h3>

                            <p class="price-detail-wrap">
                                <span class="price h2 text-warning">
                                    <span class="currency">R$ </span><span class="num"><?php echo $produto['tb_produto_preco']; ?></span>
                                </span>
                            </p> <!-- price-detail-wrap .// -->
                            <dl class="param param-feature">
                                <dt>Marca</dt>
                                <dd><?php echo $produto['tb_fornecedor_nome']; ?></dd>
                            </dl> <!-- item-property-hor .// -->

                            <hr>
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <dl class="param param-inline">

                                            <dt>Quantidade : </dt>
                                            <dd>
                                                <select class="form-control form-control-sm" name="txtqtd">
                                                    <?php
                                                    foreach ($lista as $produto) {
                                                        if ($produto['tb_produto_estoque'] == 0 or $produto['tb_produto_estoque'] == null) {
                                                    ?>
                                                            <option value="0">ESGOTADO</option>
                                                            <?php
                                                        } else {
                                                            for ($i = 1; $i <= $produto['tb_produto_estoque']; $i++) {
                                                            ?>
                                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </select>
                                            </dd>
                                        </dl> <!-- item-property .// -->
                                    </div> <!-- col.// -->
                                    <div class="col-sm-7">

                                    </div> <!-- col.// -->
                                </div> <!-- row.// -->
                                <hr>

                                <input type="submit" value="Adicionar ao Carrinho" class="btn btn-lg btn-outline-success text-uppercase"> <i class="fas fa-shopping-cart"></i>

                                <?php
                                if ($_POST) {
                                    $quantidade = $_POST['txtqtd'];
                                    if (empty($_SESSION['login'])) {

                                        echo "<script>window.location.href = 'login-cadastro/Login.php';</script>";
                                    } else if ($quantidade == null or $quantidade == 0) {
                                ?>
                                        <br>
                                        <br>
                                        <div class="alert alert-danger" role="alert" id="alerta">PRODUTO ESGOTADO
                                        </div>
                                <?php
                                    } else {
                                        $valorproduto = $produto['tb_produto_preco'];

                                        $clienteid = $_SESSION['nome'];

                                        $listacarrinho = listarCarrinho($conexao, $clienteid);
                                        foreach ($listacarrinho as $carrinho) {
                                            $carrinhoid = $carrinho['tb_carrinho_id'];
                                        }
                                        if (verificarCarrinho($conexao, $clienteid, $idproduto) == 0) {
                                            if (cadastrarCarrinho($conexao, $idproduto, $quantidade, $valorproduto, $clienteid)) {
                                                echo "<script>window.location.href = 'Carrinho.php';</script>";
                                                echo "cadastrou";
                                            } else {
                                                echo 'erro !';
                                            }
                                        } else {
                                            if (AtualizarQuantidadeCarrinho($conexao, $carrinhoid, $quantidade, $valorproduto)) {
                                                echo "<script>window.location.href = 'Carrinho.php';</script>";
                                                echo "atualizou";
                                            } else {
                                                echo 'erro !';
                                            }
                                        }
                                    }
                                }

                                ?>
                            </form>
                        </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card.// -->
        </div>
        <!--container.//-->
    <?php } ?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>