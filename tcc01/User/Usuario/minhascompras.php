<?php
include("../../conexao.php");
include("../../banco/banco-usuario.php");
include("../../banco/banco-produto.php");
include("../../banco/banco-carrinho.php");
include("../../banco/vendas-admin.php");

SESSION_start();

if (empty($_SESSION['login'])) {
    header('location:../login-cadastro/Login.php');
} else {
    $clienteid = $_SESSION['nome'];
}




$lista = listarClienteid($conexao, $clienteid);

foreach ($lista as $cliente) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta HTTP-EQUIV='refresh' CONTENT='5'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <style>
            body {
                background-color: whitesmoke;
            }

            #barra {
                background-color: #ed620c;

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

            #barra-lateral {
                width: 15%;
                float: left;
                margin-right: 2%;
            }

            #dados {
                padding-left: 5%;
                margin-left: 14%;
                width: 80%;
            }

            #txtbusca {
                width: 50%;
                margin-left: 5%;
            }

            @media (max-width: 1024px) {
                #txtbusca {
                    width: 50%;
                    margin-right: 5%;
                }
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

            @media (max-width: 700px) {
                #logo {
                    display: none;
                }

                #rodape {
                    height: 60%;
                }

                #txtbusca {
                    width: 50%;
                    margin-right: 20%;
                }

                #barra-lateral {
                    width: 50%;
                    float: none;
                }

                #dados {
                    margin-left: 1%;
                    width: 90%;
                }

            }
        </style>
        <title>Minha Conta</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark static-top" id="barra">
            <div class="container">
                <img id="logo" src="../arquivos/MARKETOHOME Logo2.png" width=80 height=60>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <!--Barra de busca-->
                <form method="get" id="txtbusca">
                    <br>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar Produtos" name="txtpesquisar" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-light" value="Buscar" disabled>
                        </div>
                    </div>
                </form>

                <div class="collapse navbar-collapse" id="navbarResponsive" style="padding-top: 2%;">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-link active">
                            <p>
                                <a class="nav-link" href="../index.php"> Home</a>
                            </p>
                        </li>
                        <?Php

                        if (empty($_SESSION['login'])) {
                        ?>
                            <li class="nav-item active">
                                <p>
                                    <a class="nav-link" href="../login-cadastro/Cadastro.php">Criar Conta</a>
                                </p>
                            </li>

                            <li class="nav-item active">
                                <p>
                                    <a class="nav-link" href="../login-cadastro/Login.php">Entrar</a>
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
                                        <a class="nav-link" href="../Carrinho.php">Carrinho (<?php echo ContarCarrinho($conexao, $clienteid);
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
                                            <a class="dropdown-item" href="minhascompras.php">Compras</a>
                                            <a class="dropdown-item" href="minhaconta.php">Meus Dados</a>
                                        </div>
                                    </div>
                                </li>


                                <li class="nav-link active">
                                    <p>
                                        <a class="nav-link" href="../Logout.php"> Sair</a>
                                    </p>
                                </li>
                            <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="list-group" id="barra-lateral">
            <a href="minhascompras.php" class="list-group-item list-group-item-action active" style="background-color: #ed620c;border-color: #ed620c;">Compras</a>
            <a href="minhaconta.php" class="list-group-item list-group-item-action "> Meus dados </a>
        </div>
        <br>

        <div class="container" id="dados">
            <div class="table-responsive">
                <table class="table table-striped">
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Preço(R$)</th>
                    <th>Quantidade</th>
                    <th>Total(R$)</th>
                    <th>Status</th>
                    <th>Metódo</th>

                    <?php
                    $lista = listarVendasId($conexao, $clienteid);

                    foreach ($lista as $venda) {
                    ?>
                        <tr>
                            <td><?php echo $venda['tb_venda_data']; ?> </td>
                            <td> <a style="text-decoration: none;" href="../Produto.php?idproduto='<?php echo $venda['tb_produto_id'] ?>'"><?php echo $venda['tb_produto_nome']; ?></a></td>
                            <td><?php echo $venda['tb_produto_preco']; ?> </td>
                            <td><?php echo $venda['tb_carrinho_quantidade']; ?> </td>
                            <td><?php echo ($venda['tb_produto_preco'] * $venda['tb_carrinho_quantidade']); ?> </td>
                            <td><?php if ($venda['tb_carrinho_ativo'] == 0) {
                                    echo "PAGO";
                                } else if ($venda['tb_carrinho_ativo'] == 2) {
                                    echo "PENDENTE";
                                }
                                ?> </td>
                            <td><?php if ($venda['tb_venda_metodopag'] == 0) {
                                    echo "Dinheiro";
                                } else {
                                    echo "Cartão";
                                }
                                ?>
                            </td>
                        <tr>
                        <?php } ?>
                </table>
            </div>

        </div>



    <?php
}
    ?>

    <div id="barra" id="rodape" style="width: 100%;height: 26%; margin-top: 20%;position: absolute;">
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>

    </html>