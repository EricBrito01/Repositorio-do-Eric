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
            float: right;
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
    </style>
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
                <h2>Alterar Endereço</h2>
                <hr><br>
                <h5>Detalhes do endereço</h5>

                <div class="caixa">
                    <form method="POST">
                        <?php foreach ($listacliente as $cliente) { ?>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="width: 70%;margin-left: 10%;">Endereço</label>
                                <input class="form-control" style="width: 70%;margin-left: 10%;" value="<?php echo $cliente['tb_cliente_endereco']; ?>" name="endereco">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="width: 70%;margin-left: 10%;">Bairro</label>
                                <input class="form-control" style="width: 70%;margin-left: 10%;" value="<?php echo $cliente['tb_cliente_bairro']; ?>" name="bairro">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" style="width: 70%;margin-left: 10%;">Cidade</label>
                                <input class="form-control" style="width: 70%;margin-left: 10%;" value="<?php echo $cliente['tb_cliente_cidade'];
                                                                                                    } ?>" name="cidade">
                            </div>

                            <input id="botao" class="btn btn-block btn btn-success" style="width: 98%;"  type="submit" value='Alterar   '>

                            <?php
                            if ($_POST) {
                                $endereco = $_POST['endereco'];
                                $bairro = $_POST['bairro'];
                                $cidade = $_POST['cidade'];

                                if (alterarClienteEndereco($conexao, $clienteid, $endereco, $bairro, $cidade)) {
                            ?>
                                    <br>
                                    <div class="alert alert-success" role="alert" id="alerta">Alterado com Sucesso !
                                    </div>
                                <?php
                                    header('location:Pagamento.php');
                                } else {
                                ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert" id="alerta">Informações Invalídas !
                                    </div>
                            <?php
                                }
                            }
                            ?>
                    </form>
                </div>
            </div>
        </div>
        <div id="tela-pagamento">
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

                                    <input type="hidden" name="http_method" value="delete" />
                                    <?php
                                    if ($_POST) {
                                        $data  = date('d-m-y');
                                        foreach ($lista as $carrinho) {
                                            $carrinhoid = $carrinho['tb_carrinho_id'];
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
    </div>

</body>

</html>