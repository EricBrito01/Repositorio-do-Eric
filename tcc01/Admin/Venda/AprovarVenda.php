<?php

include("./../../conexao.php");
include("../../banco/vendas-admin.php");

SESSION_start();
if (empty($_SESSION['loginADM'])) {
    header('location:.././admin/Login-admin.php');
}

$carrinhoid = $_GET['carrinhoid'];
echo $carrinhoid;


if (AprovarVenda($conexao,$carrinhoid))
{
    header('location:Listar-vendas.php');
}