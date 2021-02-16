<!DOCTYPE html>
<?php
SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:../admin/Login-admin.php');
}
include("./../../conexao.php");
include("../../banco/upload.php");



?>
<html>
<title>Cadastro de Produto</title>
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
                <li><a href="Cadastro-produto.php">Cadastrar</a></li>
                <li><a href="Listar-produto.php">Listar</a></li>
            </ul>
        </ul>
        <ul>
            <li>Venda</li>
            <ul>
                <li><a href="../Venda/Listar-vendas.php">Listar</a></li>
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
    <div class="container" style="margin-left:15%;">
        <h1>Salvar imagem dos Produtos</h1>
        <hr>
        <br>
        <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Imagem:
            <br>
            <input type="file" name="imagem" />
            <br>
            <br>
            Descrição: <input class="form-control" type="text" name="txtdesc">
            <br>
            <br>
            <input class="btn btn-success" type="submit" name="btncadastrar" value="Salvar">
        </form>
        <BR>
        <?php
        if (isset($_POST['btncadastrar'])) :
            $descricao = $_POST['txtdesc'];
            $formatosPermitidos = array("png", "jpeg", "jpg");
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

            if (in_array($extensao, $formatosPermitidos)) :
                $pasta = "imagens/";
                $temporario = $_FILES['imagem']['tmp_name'];
                $novo_nome = uniqid() . ".$extensao";


                if(move_uploaded_file($temporario, $pasta.$novo_nome)):
                    $mensagem = "Upload feito com sucesso";
                    if(SalvarImagem($conexao, $descricao, $novo_nome)):
                        $mensagem = "UPLOAD FEITO COM SUCESSO";
                        $erro=false;
                        if($erro){
                            
                        }else{
                            echo "<script>window.location.href = 'Cadastro-Produto.php';</script>";
                        }
                    endif;
                else:
                    $mensagem = "Erro, não foi possivel fazer o upload";
                endif;
            else:
                $mensagem = "Formato Invalido";
            endif;
            echo $mensagem;
        endif;
        ?>
    </div>
</body>

</html>