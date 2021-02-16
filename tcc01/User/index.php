<?php
include("../conexao.php");
include("../banco/banco-usuario.php");
include("../banco/banco-produto.php");
include("../banco/banco-carrinho.php");
session_start();
$listacard = listarProdutoAsc($conexao);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <style>
        body {
            background-color: whitesmoke;
        }

        #barra {
            background-color: #ed620c;

        }

        .imagem {
            width: 300px;
            height: 250px;
        }

        .text {
            text-align: left;
            margin-top: 3%;
            margin-left: 5%;
            font-size: 2.0em;
        }

        .desc {
            text-align: left;
            margin-top: 2%;
            margin-left: 5%;
            font-size: 1.0em;
        }

        .card-product .img-wrap {
            border-radius: 3px 3px 0 0;
            overflow: hidden;
            position: relative;
            height: 220px;
            text-align: center;
        }

        .card-product .img-wrap img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        .card-product .info-wrap {
            overflow: hidden;
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .card-product .bottom-wrap {
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .label-rating {
            margin-right: 10px;
            color: #333;
            display: inline-block;
            vertical-align: middle;
        }

        .card-product .price-old {
            color: #999;
        }

        #rodape {
            width: 100%;
            height: 26%;
            margin-top: 5%;
            position: absolute;
        }

        #carrossel-index {
            width: 300px;
            height: 550px;
        }

        a.nav-link:hover {
            color: AntiqueWhite !important;
        }

        a.nav-link {
            color: white !important;
        }

        button.btn-primary:hover {
            color: AntiqueWhite !important;
        }

        @media (max-width: 768px) {
            #carrossel-index {
                width: 300px;
                height: 250px;
            }

            #logo {
                display: none;
            }

            #rodape {
                height: 40%;
            }

            #txtbusca {
                width: 50%;
            }

            .imagem {
                padding-top: 3%;
                width: 250px;
                height: 200px;
            }
        }
    </style>
    <meta content='width=device-width, initial-scale=0.9' name='viewport'>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="barra">
        <div class="container">
            <img id="logo" src="arquivos/MARKETOHOME Logo2.png" width=80 height=60>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <!--Barra de busca-->
            <form method="get" style="width: 50%;margin-left: 5%;">
                <br>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="txtbusca" placeholder="Buscar Produtos" name="txtpesquisar" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-outline-light" value="Buscar">
                    </div>
                </div>
                <?php
                if ($_GET) {
                    if (isset($_SESSION['buscar'])) {
                        $nome = $_SESSION['buscar'];
                        $lista = pesquisarProduto($conexao, $nome);
                        echo 'foi';
                        if ($lista == null) {
                            $aviso = "Nenhum Produto encontrado";
                            $lista = listarProduto($conexao);
                        } else {
                            $aviso = null;
                        }
                        
                    } else {
                        $nome = $_GET['txtpesquisar'];
                        $lista = pesquisarProduto($conexao, $nome);

                        if ($lista == null) {
                            $aviso = "Nenhum Produto encontrado";
                            $lista = listarProduto($conexao);
                        } else {
                            $aviso = null;
                        }
                    }
                } else {
                    $lista = listarProduto($conexao);
                    $aviso = null;
                }
                ?>

            </form>

            <div class="collapse navbar-collapse" id="navbarResponsive" style="padding-top: 2%;">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-link active">
                        <p>
                            <a class="nav-link" href="index.php"> Home</a>
                        </p>
                    </li>
                    <?Php
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

    <?php
    if ($_GET) {
    } else {
    ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" id="carrossel-index" src="arquivos/promoções/MARKETOHOMEbanner(1).png" alt="Primeiro Slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" id="carrossel-index" src="arquivos/promoções/MARKETOHOMEbanner2(1).png" alt="Segundo Slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" id="carrossel-index" src="arquivos/promoções/MARKETOHOMEbanner3(1).png" alt="Terceiro Slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
        <br>
        <br>
    <?php
    }
    ?>

    <div class="container" id="conteudo">
        <br>
        <p style="text-align: center; width: 100%; font-size: 150%;"> <?php echo $aviso; ?> </p>
        <hr><br> <br>
        <div class="row">
            <?php

            foreach ($lista as $produto) {

            ?>
                <div class="col-md-4">
                    <a style="text-decoration: none;color: black" href="Produto.php?idproduto='<?php echo $produto['tb_produto_id'] ?>'">
                        <figure class="card card-product">
                            <div class="img-warp">
                                <img class="imagem" src="../Admin/Produto/imagens/<?php echo $produto['tb_imagens_prdt_imagem'] ?>">
                            </div>
                            <figcaption bclass="info-wrap">
                                <h4 class="text"><?php echo $produto['tb_produto_nome'];
                                                    $string = $produto['tb_produto_nome'];
                                                    $contString = strlen($string);

                                                    if ($contString <= 20) {
                                                    ?><br><br><?php
                                                            }
                                                                ?>
                                </h4>
                                <p class="desc">Produzido por <?php echo $produto['tb_fornecedor_nome']; ?></p>
                            </figcaption>
                    </a>
                    <div class="bottom-wrap">
                        <div class="price-wrap h3">
                            <span class="price-new">R$<?php echo $produto['tb_produto_preco'] ?></span>
                        </div> <!-- price-wrap.// -->
                    </div> <!-- bottom-wrap.// -->

                    </figure>
                </div>


            <?php } ?>
        </div>
    </div>
    </div>


    <div id="barra" id="rodape" style="width: 100%;height: 26%; margin-top: 5%;position: absolute;">
        <div class="conteiner">
            <h4 style="margin-top: 2%;color: whitesmoke; margin-left: 15%;">Fale Conosco</h4>
            <ul style="color: whitesmoke;margin-left: 15%">
                <li>marketohomegroup@gmail.com</li>
                <li>(11) 98031-8516</li>
                <li>Av. Paulista, São Paulo-SP</li>
            </ul>
            <p style="margin-top: 1%;text-align: center;color: whitesmoke;">Copyright © 2020 MarkeToHome LTDA.</p>
        </div>
    </div>

    <div class="back-to-top" href="#"></div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>