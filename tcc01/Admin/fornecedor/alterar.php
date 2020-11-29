<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:.././admin/Login-admin.php');
}
include("./../../conexao.php");
include("../../banco/banco-fornecedores.php");

$idfornecedor = $_GET['idforn'];

$listaid = listaridFornecedor($conexao, $idfornecedor);

foreach ($listaid as $fornecedor) {
?>
    <html>
    <title>Alterar Fornecedor</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    </head>

    <body>
        <div class="container">
            <h1>Alterar Fornecedor</h1>
            <hr>
            <br>
            <form method="post">
                ID: <input class="form-control" type="text" readonly="true" name="txtnome" value="<?php echo $idfornecedor ?>">
                <br>
                <br>
                Nome: <input class="form-control" type="text" name="txtnome" value="<?php echo $fornecedor['tb_fornecedor_nome'] ?>">
                <br>
                <br>
                CNPJ: <input class="form-control" type="text" name="txtcnpj" placeholder="Sem traços ou pontos" value="<?php echo $fornecedor['tb_fornecedor_cnpj'] ?>">
                <br>
                <br>
                Endereço: <input class="form-control" type="text" name="txtendereco" value="<?php echo $fornecedor['tb_fornecedor_endereco'] ?>">
                <br>
                <br>
                Bairro: <input class="form-control" type="text" name="txtbairro" value="<?php echo $fornecedor['tb_fornecedor_bairro'] ?>">
                <br>
                <br>
                Cidade: <input class="form-control" type="text" name="txtcidade" value="<?php echo $fornecedor['tb_fornecedor_cidade'] ?>">
                <br>
                <br>
                Email: <input class="form-control" type="text" name="txtemail" value="<?php echo $fornecedor['tb_fornecedor_email'] ?>">
                <br>
                <br>
                Telefone: <input class="form-control" type="text" name="txttel" value="<?php echo $fornecedor['tb_fornecedor_tel'] ?>">
                <br>
                <br>
                <input class="btn btn-success" type="submit" name="btncadastrar" value="Alterar">
            </form>

            <?php
            if ($_POST) {
                $nome_fornecedor = $_POST['txtnome'];
                $tel_fornecedor = $_POST['txttel'];
                $cnpj_fornecedor = $_POST['txtcnpj'];
                $endereco_fornecedor = $_POST['txtendereco'];
                $bairro_fornecedor = $_POST['txtbairro'];
                $cidade_fornecedor = $_POST['txtcidade'];
                $email_fornecedor = $_POST['txtemail'];
                if (valida_cnpj($cnpj_fornecedor)) {
                    if (alterarFornecedor($conexao, $nome_fornecedor, $cnpj_fornecedor, $endereco_fornecedor, $bairro_fornecedor, $cidade_fornecedor, $email_fornecedor, $tel_fornecedor, $idfornecedor)) {
            ?>
                        <br>
                        <div class="alert alert-success" role="alert" id="alerta">Alterado com Sucesso !
                        </div>
                    <?php
                        header('location:Listar-fornecedores.php');
                    } else {
                    ?>
                        <br>
                        <div class="alert alert-danger" role="alert" id="alerta">Informações Invalídas !
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <br>
                    <div class="alert alert-danger" role="alert" id="alerta">CNPJ Invalído !
                    </div>
        <?php
                }
            }
        }
        ?>

    </body>

    </html>