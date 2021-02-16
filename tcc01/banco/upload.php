<?php
function SalvarImagem($conexao, $descricao, $novo_nome ) {
    $sql_code = "INSERT INTO tb_imagens_prdt ( tb_imagens_prdt_desc, tb_imagens_prdt_imagem) VALUES('$descricao', '$novo_nome')";
   
    return mysqli_query($conexao, $sql_code);
}



function ListarImagem($conexao) {

    $sql = "select * from tb_imagens_prdt  order by tb_imagens_prdt_id desc  ";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($imagem = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $imagem);
    }
    return $lista;
}

function AlterarImagem($conexao,$descricao, $novo_nome, $idImagem) {
    $sql = "update tb_imagens_prdt set tb_imagens_prdt_desc = '$$descricao',tb_imagens_prdt_imagem = '$novo_nome' where tb_imagens_prdt_id = $idImagem";
    return mysqli_query($conexao, $sql);
}

?>
