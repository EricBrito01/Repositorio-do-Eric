<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:Login-admin.php');
}
include("./../../conexao.php");
include("../../banco/banco-funcionarios.php");

$admin_id = $_GET['idadmin'];

$listaid = listarIDadmin($conexao, $admin_id);

foreach ($listaid as $admin) {
?>
    <html>

    <head>
    <meta HTTP-EQUIV='refresh' CONTENT='20'>
        <title>Alterar Funcionario</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <meta charset="utf-8">
    </head>

    <body>
        <div class="container">
            <?php
            echo 'Bem vindo,' . $_SESSION['adm'] . ' ';
            ?>
            <a style="margin-left: 1%;" href="../Logout.php">Sair</a>
            <br><br>
        </div>
        <div style="float: left;">
            <ul>
                <li>Produto</li>
                <ul>
                    <li><a href="../Produto/Cadastro-produto.php">Cadastrar</a></li>
                    <li><a href="../Produto/Listar-produto.php">Listar</a></li>
                </ul>
            </ul>
            <ul>
                <li>Venda</li>
                <ul>
                    <li><a href="../Venda/Listar-vendas.php">Listar(<?php
                                                                    include("../../banco/vendas-admin.php");

                                                                    echo ContarVendas($conexao);
                                                                    ?>)</a></li>
                </ul>
            </ul>
            <ul>
                <li>Cliente</li>
                <ul>
                    <li><a href="../cliente/Listar-clientes.php">Listar</a></li>
                </ul>
            </ul>
            <ul>
                <li>Funcionário</li>
                <ul>
                    <li><a href="../admin/Cadastro-admin.php">Cadastrar</a></li>
                    <li><a href="../admin/Listar-admin.php">Listar</a></li>
                </ul>
            </ul>
            <ul>
                <li>Fornecedor</li>
                <ul>
                    <li><a href="../fornecedor/Cadastro-fornecedor.php">Cadastrar</a></li>
                    <li><a href="../fornecedor/Listar-fornecedores.php">Listar</a></li>
                </ul>
            </ul>
        </div>
        <div class="container">
            <h1>Alterar Funcionário</h1>
            <hr>
            <br>
            <form method="post">
                ID: <input class="form-control" type="text" readonly="true" name="txtnome" value="<?php echo $admin_id ?>">
                <br>
                <br>
                Nome: <input class="form-control" type="text" name="txtnome" value="<?php echo $admin['tb_admin_nome'] ?>">
                <br>
                <br>
                Senha: <input class="form-control" type="password" name="txtsenha" value="<?php echo $admin['tb_admin_senha'] ?>">
                <br>
                <br>
                <input class="btn btn-success" type="submit" name="btncadastrar" value="Alterar">
            </form>

            <?php
            if ($_POST) {
                $nome_admin = $_POST['txtnome'];
                $senha_admin = $_POST['txtsenha'];

                if (alterarAdmin($conexao, $nome_admin, $senha_admin, $admin_id)) {
            ?>
                    <br>
                    <div class="alert alert-success" role="alert" id="alerta">Alterado com Sucesso !
                    </div>
                <?php
                    header('location:Listar-Admin.php');
                } else {
                ?>
                    <br>
                    <div class="alert alert-danger" role="alert" id="alerta">Informações Invalídas !
                    </div>
        <?php
                }
            }
        }
        ?>

    </body>

    </html>