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
    $listacliente = listarClienteid($conexao, $clienteid);

    $lista = listarCarrinho($conexao, $clienteid);

    $listaSoma = somarCarrinho($conexao, $clienteid);
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
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

        #tela-envio {
            display: inline-flexbox;
            background-color: Gainsboro;
            width: 50%;
            height: 50%;
            margin-top: 2%;
            float: left;
            margin-left: 3%;
            border-radius: 10px;
        }

        #tela-pagamento {
            display: inline-flexbox;
            width: 40%;
            margin-right: 3%;
            margin-top: 2%;
        }

        #tela-envio-dentro {
            margin: 4%;
        }

        .caixa {
            background-color: lightgray;
            width: 90%;
            height: 20%;
            margin-top: 2%;
            border-radius: 10px;
            padding-left: 2%;
            padding-top: 2%;
            padding-bottom: 1%;
        }

        #pagamento {
            background-color: lightgray;
            width: 100%;
            height: 20%;
            margin-top: 2%;
            border-radius: 10px;
            padding-left: 5%;
            padding-top: 2%;
            padding-bottom: 3%;
            text-align: left;
            margin-bottom: 3%;
        }

        @media screen and (max-width:1000px) {
            #tela-envio {
                width: 97%;
                float: none;
                margin-right: 2%;
                margin-left: 2%;
                padding-bottom: 5%;
            }

            #tela-pagamento {
                display: inline-flexbox;
                width: 97%;
                margin-right: 2%;
                margin-top: 10%;

            }
        }
    </style>
    <meta content='width=device-width, initial-scale=0.9' name='viewport'>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark  static-top" id="barra">
        <div class="container">
            <img id="logo" src="arquivos/MARKETOHOME Logo2.png" width=80 height=60>
        </div>
    </nav>

    <div class="conteiner">
        <div id="tela-envio">
            <div id="tela-envio-dentro">
                <h2>Revise e confirme sua compra</h2>
                <hr><br>
                <h5>Detalhes do envio</h5>

                <div class="caixa">
                    <h6>Envio Padrão</h6>
                    <h6>
                        <?php foreach ($listacliente as $cliente) {
                            echo $cliente['tb_cliente_endereco'] ?>
                    </h6>
                    <P>
                    <?php
                            echo  $cliente['tb_cliente_bairro']
                                . ", " . $cliente['tb_cliente_cidade'];
                        }
                    ?>
                    </P>
                    <a href="Alterar-Endereco.php" style="text-align: right;"> Alterar Endereço</a>
                </div>

                <div class="caixa">
                    <h6>Prazo de entrega</h6>
                    <p>Chegará no PROXIMO DIA ÚTIL entre 12:00 e 22:00</p>
                </div>
                <br>
                <br>
            </div>
        </div>

        <div class="container mb-4" id="tela-pagamento">
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
                                        <td><img class="imagem" src="../Admin/Produto/imagens/<?php echo $produto['tb_imagens_prdt_imagem'] ?>"> </td>
                                        <td><?php echo $produto['tb_produto_nome'] ?></td>
                                        <td>Em estoque</td>
                                        <td><input class="form-control" disabled type="text" value="<?php echo $produto['tb_carrinho_quantidade'] ?>" /></td>
                                        <td class="text-right">R$ <?php echo $produto['tb_produto_preco'] ?> </td>
                                        <td></td>
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
                                                                    foreach ($listaSoma as $soma) {
                                                                        $_SESSION['soma'] = $soma['sum(tb_carrinho_preco)'];
                                                                        echo $soma['sum(tb_carrinho_preco)'];
                                                                    }
                                                                    ?></strong></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 text-right">
                            <form method="post">
                                <div id="pagamento">
                                    <h5>Detalhes do Pagamento</h5>
                                    <div class="form-check" style="padding-bottom: 2%;">
                                        <input class="form-check-input" type="radio" name="rbpagamento" id="gridRadios1" value="0" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Dinheiro
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rbpagamento" id="gridRadios2" value="1">
                                        <label class="form-check-label" for="gridRadios2">
                                            Cartão (No ato da entrega)
                                        </label>
                                    </div>
                                </div>
                                <input id="botao" class="btn btn-block btn btn-success"  type="submit" value='Confirmar Compra'>
                                <input type="hidden" name="http_method" value="delete" />
                                <?php
                                if ($_POST) {
                                    $data  = date('d-m-y');
                                    foreach ($lista as $carrinho) {
                                        $carrinhoid = $carrinho['tb_carrinho_id'];
                                        $metodopag = $_POST['rbpagamento'];
                                        if (finalizarCarrinho($conexao, $data, $clienteid, $carrinhoid, $metodopag)) {

                                            foreach ($lista as $carrinho) {
                                                PagamentoPendente($conexao, $carrinhoid);
                                            }
                                            $idproduto = $carrinho['tb_produto_id'];
                                            $quantidade = $carrinho['tb_carrinho_quantidade'];
                                            DiminuirEstoque($conexao, $idproduto, $quantidade);

                                            echo "<script>window.location.href = 'Finalizar.php';</script>";
                                        } else {
                                            echo 'erro !';
                                        }
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
    </div>
</body>

</html>