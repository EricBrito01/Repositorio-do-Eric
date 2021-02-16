<!DOCTYPE html>
<?php
include("../conexao.php");
include("../banco/banco-usuario.php");
include("../banco/banco-produto.php");
include("../banco/banco-carrinho.php");

SESSION_start();
if (empty($_SESSION['login'])) {
    header('location:login-cadastro/Login.php');
} else {
    $clienteid = $_SESSION['nome'];

    $lista = listarCarrinho($conexao, $clienteid);

    $listaSoma = somarCarrinho($conexao, $clienteid);
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style>
         body {
            background-color: whitesmoke;
        }

        #barra {
            background-color: #ed620c;

        }

        .imagem {
            width: 50px;
            height: 50px;
        }

        .bloc_left_price {
            color: #c01508;
            text-align: center;
            font-weight: bold;
            font-size: 150%;
        }

        .category_block li:hover {
            background-color: #007bff;
        }

        .category_block li:hover a {
            color: #ffffff;
        }

        .category_block li a {
            color: #343a40;
        }

        .add_to_cart_block .price {
            color: #c01508;
            text-align: center;
            font-weight: bold;
            font-size: 200%;
            margin-bottom: 0;
        }

        .add_to_cart_block .price_discounted {
            color: #343a40;
            text-align: center;
            text-decoration: line-through;
            font-size: 140%;
        }

        .product_rassurance {
            padding: 10px;
            margin-top: 15px;
            background: #ffffff;
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .product_rassurance .list-inline {
            margin-bottom: 0;
            text-transform: uppercase;
            text-align: center;
        }

        .product_rassurance .list-inline li:hover {
            color: #343a40;
        }

        .reviews_product .fa-star {
            color: gold;
        }

        .pagination {
            margin-top: 20px;
        }

        footer {
            background: #343a40;
            padding: 40px;
        }

        footer a {
            color: #f8f9fa !important
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
                width: 0;
            }
        }
    </style>

    <meta content='width=device-width, initial-scale=0.9' name='viewport'>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="barra">
        <div class="container">
            <img id="logo" src="arquivos/MARKETOHOME Logo.png" width=80 height=60>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <!--Barra de busca-->
            <form method="get" style="width: 50%;margin-left: 5%;">
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

                    if (empty($_SESSION['login'])) {
                    ?>
                        <li class="nav-item active">
                            <p>
                                <a class="nav-link" href="login-cadastro/Cadastro.php">Criar Conta</a>
                            </p>
                        </li>

                        <li class="nav-item active">
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

    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Produto</th>
                                <th scope="col">Disponibilidade</th>
                                <th scope="col" class="text-center">Quantidade</th>
                                <th scope="col" class="text-right">Preço</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($lista as $produto) {
                            ?>
                                <tr>
                                    <td> <img class="imagem" src="../Admin/Produto/imagens/<?php echo $produto['tb_imagens_prdt_imagem'] ?>"></td>
                                    <td><?php echo $produto['tb_produto_nome'] ?></td>
                                    <td>Em estoque</td>
                                    <td><input class="form-control" disabled type="text" value="<?php echo $produto['tb_carrinho_quantidade'] ?>" /></td>
                                    <td class="text-right">R$ <?php echo $produto['tb_produto_preco'] ?> </td>
                                    <td class="text-right"><a href="produto/deletar.php?idproduto='<?php echo $produto['tb_produto_id'] ?>'"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button></a></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td class="text-right"><strong><?php
                                                                foreach ($listaSoma as $sum) {
                                                                    $soma = $sum['sum(tb_carrinho_preco)'];
                                                                    echo $soma;
                                                                }
                                                                ?></strong></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="Index.php"><button class="btn-block btn btn-outline-primary">Continuar Comprando</button></a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <form method="post">
                            <?php if ($soma != null) {

                                if ($soma < 10) {     ?>
                                    <input class="btn btn-block btn-outline-success" type="submit" value='Finalizar' disabled>
                                    <br>
                                    <div class="alert alert-danger" role="alert" id="alerta">Carrinho abaixo de R$ 10,00
                                    </div>
                                <?php
                                } else { ?>
                                    <input class="btn btn-block btn-outline-success" type="submit" value='Finalizar'>
                                <?php
                                }
                            } else { ?>
                                <br>
                                <h3 style="text-align: center;">O seu Carrinho está vazio !</h3>
                            <?php
                            }
                            ?>


                            <input type="hidden" name="http_method" value="delete" />
                            <?php
                            if ($_POST) {
                                $data  = date('d-m-y');
                                foreach ($lista as $carrinho) {
                                    $carrinhoid = $carrinho['tb_carrinho_id'];
                                    echo "<script>window.location.href = 'Pagamento.php';</script>";
                                }
                            }

                            ?>
                            <br />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>