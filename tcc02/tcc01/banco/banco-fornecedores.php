<?php

function cadastrarFornecedor($conexao,$nome_fornecedor, $cnpj_fornecedor,$endereco_fornecedor,$bairro_fornecedor,$cidade_fornecedor,$email_fornecedor,$tel_fornecedor ) {
    $sql = "insert into tb_fornecedor
    (tb_fornecedor_nome, tb_fornecedor_cnpj, tb_fornecedor_endereco,tb_fornecedor_bairro,tb_fornecedor_cidade,tb_fornecedor_email,tb_fornecedor_tel) 
     values ('$nome_fornecedor', '$cnpj_fornecedor','$endereco_fornecedor','$bairro_fornecedor','$cidade_fornecedor','$email_fornecedor','$tel_fornecedor');";
    return mysqli_query($conexao, $sql);
}


function alterarFornecedor($conexao,$nome_fornecedor, $cnpj_fornecedor,$endereco_fornecedor,$bairro_fornecedor,$cidade_fornecedor,$email_fornecedor,$tel_fornecedor,$idfornecedor) {
    $sql = "update tb_fornecedor set tb_fornecedor_nome = '$nome_fornecedor',tb_fornecedor_cnpj = '$cnpj_fornecedor', tb_fornecedor_endereco='$endereco_fornecedor',tb_fornecedor_bairro='$bairro_fornecedor',tb_fornecedor_cidade='$cidade_fornecedor',tb_fornecedor_email='$email_fornecedor',tb_fornecedor_tel = '$tel_fornecedor' where tb_fornecedor_id = $idfornecedor";
    return mysqli_query($conexao, $sql);
}

function excluirFornecedor($conexao, $fornecedor_id) {
     $sql = "delete from tb_fornecedor where tb_fornecedor_id like $fornecedor_id ";
    return mysqli_query($conexao, $sql);
}

function listarFornecedor($conexao) {

    $sql = "select * from tb_fornecedor order by tb_fornecedor_id desc" ;

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($fornecedor = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $fornecedor);
    }
    return $lista;
}

function listaridFornecedor($conexao,$idfornecedor) {

    $sql = "select * from tb_fornecedor where tb_fornecedor_id = $idfornecedor";

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($fornecedor = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $fornecedor);
    }
    return $lista;
}

function valida_cnpj ( $cnpj ) {
    // Deixa o CNPJ com apenas números
    $cnpj = preg_replace( '/[^0-9]/', '', $cnpj );
    
    // Garante que o CNPJ é uma string
    $cnpj = (string)$cnpj;
    
    // O valor original
    $cnpj_original = $cnpj;
    
    // Captura os primeiros 12 números do CNPJ
    $primeiros_numeros_cnpj = substr( $cnpj, 0, 12 );
    
    /**
     * Multiplicação do CNPJ
     *
     * @param string $cnpj Os digitos do CNPJ
     * @param int $posicoes A posição que vai iniciar a regressão
     * @return int O
     *
     */
    if ( ! function_exists('multiplica_cnpj') ) {
        function multiplica_cnpj( $cnpj, $posicao = 5 ) {
            // Variável para o cálculo
            $calculo = 0;
            
            // Laço para percorrer os item do cnpj
            for ( $i = 0; $i < strlen( $cnpj ); $i++ ) {
                // Cálculo mais posição do CNPJ * a posição
                $calculo = $calculo + ( $cnpj[$i] * $posicao );
                
                // Decrementa a posição a cada volta do laço
                $posicao--;
                
                // Se a posição for menor que 2, ela se torna 9
                if ( $posicao < 2 ) {
                    $posicao = 9;
                }
            }
            // Retorna o cálculo
            return $calculo;
        }
    }
    
    // Faz o primeiro cálculo
    $primeiro_calculo = multiplica_cnpj( $primeiros_numeros_cnpj );
    
    // Se o resto da divisão entre o primeiro cálculo e 11 for menor que 2, o primeiro
    // Dígito é zero (0), caso contrário é 11 - o resto da divisão entre o cálculo e 11
    $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 :  11 - ( $primeiro_calculo % 11 );
    
    // Concatena o primeiro dígito nos 12 primeiros números do CNPJ
    // Agora temos 13 números aqui
    $primeiros_numeros_cnpj .= $primeiro_digito;
 
    // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
    $segundo_calculo = multiplica_cnpj( $primeiros_numeros_cnpj, 6 );
    $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 :  11 - ( $segundo_calculo % 11 );
    
    // Concatena o segundo dígito ao CNPJ
    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;
    
    // Verifica se o CNPJ gerado é idêntico ao enviado
    if ( $cnpj === $cnpj_original ) {
        return true;
    }
}

function PesquisarFornecedor($conexao,$tabela,$pesquisa) {

    $sql = "select * from tb_fornecedor where  $tabela like  '%$pesquisa%' " ;

    $lista = array();

    $resultado = mysqli_query($conexao, $sql);

    while ($fornecedor = mysqli_fetch_assoc($resultado)) {

        array_push($lista, $fornecedor);
    }
    return $lista;
}