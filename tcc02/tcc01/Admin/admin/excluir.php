<?php
SESSION_start();
if (empty($_SESSION['loginADM']))
{
    header('location:Login-admin.php');
}
$admin_id = $_GET['idadmin'];
include ("./../../conexao.php");
include("../../banco/banco-funcionarios.php");

if (excluirAdmin($conexao, $admin_id))
{
    header('location:Listar-admin.php');
}
else{
    echo 'nao funfo';
}