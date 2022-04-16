<?php
/* 
4 SEMESTRE - SISTEMAS PARA INTERNET
Author: Vinícius Lessa da Silva / Anderson Nascimento
Since: 2020/06/19
*/

/* FUNÇÃO PARA CARREGAR OS ITENS DO CARROSEL */
function carregarDestaques($conn)
{
    $sql = "SELECT cod_produto, nome_prod, descricao_prod, cover_img, banner_img FROM produto  WHERE destaque = 1 ORDER BY rand() LIMIT 8";
    $stmt = $conn->prepare($sql) ;
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $result;
}

/* FUNÇÃO PARA CARREGAR OS ITENS DE SUGESTÃO DA HOME */
function carregarSugestoes($conn)
{
    // $sql = "SELECT  a.cod_anuncio, a.valor_un, a.titulo_anuncio, a.descricao_anuncio, a.cover_img, a.cod_categoria, a.descricao_categoria
    // FROM anuncios a INNER JOIN categoria c ON a.cod_categoria = c.cod_categoria
    // WHERE a.status = 1 ORDER BY rand() LIMIT 8 ";

    // $stmt = $conn->prepare($sql) ;
    // $stmt->execute();
    // $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    // $stmt->close();
    // return $result;

    $url = "http://localhost/FATEC/_GitFinal/TG_TMC_BACKEND/SERVIDOR/anuncios.php/anuncios/";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    $resultado = json_decode(curl_exec($ch));
    return $resultado;

}