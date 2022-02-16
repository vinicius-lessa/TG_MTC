<?php
/* 
4 SEMESTRE - SISTEMAS PARA INTERNET
Author: Vinícius Lessa da Silva / Anderson Nascimento
Since: 2020/06/19
*/
/* FUNÇÕES USADAS NAS PAGINAS DE FAVORITOS */

/* FUNÇÃO PARA CADASTRAR O PRODUTO COMO FAVORITO*/
function cadastrarJogoFavorito($conn, $dados)
{
  $valores = $dados;
  $sql = 'INSERT INTO favorito (cod_produto, cod_cliente, data_inclusao ) VALUES (?,?,?)';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iis", $valores['cod_produto'], $valores['cod_ciente'], $valores['data_inclusao']);
  $result = $stmt->execute() ? true : false;

  $stmt->close();
  return $result;
}

/*FUNÇÃO PARA VERIFICAR SE O PRODUTO ESTA NOS FAVORITOS */
function consultarProdFavorito($conn, $cod_produto, $cod_cliente)
{
  $sql = "SELECT cod_favorito FROM favorito WHERE cod_cliente = ? AND cod_produto = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $cod_cliente, $cod_produto);

  /*se achar o jogo retorna a quantidade de registros ou zero*/
  $result = $stmt->execute() ? $stmt->get_result()->num_rows : false;

  $stmt->close();
  return $result;
}

/*FUNÇÃO PARA REMOVER O PRODUTO DOS FAVORITOS */
function removerJogoFavorito($conn, $dados)
{
  $valores = $dados;
  $sql = "DELETE FROM favorito WHERE cod_produto = ? AND  cod_cliente = ?  ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $valores['cod_produto'], $valores['cod_ciente']);
  $result = $stmt->execute() ? true : false;
  $stmt->close();

  return $result;
}

/*FUNÇÃO PARA LISTAR TODOS OS PRODUTOS DOS FAVORITOS */
function listarTodosFavoritos($conn, $cod_cliente)
{
  $sql = "SELECT f.data_inclusao,f.cod_produto, p.nome_prod, p.cover_img, valor_prod ,c.nome_categoria FROM favorito f 
            INNER JOIN produto p ON f.cod_produto = p.cod_produto INNER JOIN categoria c ON p.cod_categoria = c.cod_categoria
            WHERE f.cod_cliente = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $cod_cliente);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  $stmt->close();

  return $result;
}