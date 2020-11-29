<?php

SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:.././admin/Login-admin.php');
}

$fornecedor_id = $_GET['idforn'];
include ("./../../conexao.php");
include("../../banco/banco-fornecedores.php");

if (excluirFornecedor($conexao, $fornecedor_id))
{
    header('location:Listar-fornecedores.php');
}
else{
    echo 'Delete os Produtos antes de deletar o fornecedor !';
}