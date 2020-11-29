<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:Login-admin.php');
}
include ("./../../conexao.php");
include("../../banco/banco-funcionarios.php");

$admin_id = $_GET['idadmin'];

$listaid = listarIDadmin($conexao, $admin_id);

foreach ($listaid as $admin)
{
    ?>
    <html>
        <title>Alterar Funcionario</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta charset="utf-8"> 
    </head>
    <body>
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
            if ($_POST)
            {
                $nome_admin = $_POST['txtnome'];
                $senha_admin = $_POST['txtsenha'];

                if (alterarAdmin($conexao, $nome_admin, $senha_admin, $admin_id))
                {
                    ?>
                    <br>
                    <div class="alert alert-success" role="alert" id="alerta">Alterado com Sucesso !
                    </div>
                    <?php
                    header('location:Listar-Admin.php');
                }
                else
                {
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
