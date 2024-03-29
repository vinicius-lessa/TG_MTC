<?php

require_once 'Class.Conexao.php';

class CrudDB {
    // Atributos estáticos
    private static $conexao;
    private static $tabela;

    // Chamado para estabecer conexão
    public static function setConexao($conn){
        self::$conexao = $conn;
    }

    public static function setTabela($nomeTabela){
        self::$tabela = $nomeTabela;
    }

    # SQL INSERT
    public static function montaSQLInsert($arrayDados){
        $campos = implode(', ', array_keys($arrayDados));
        $params = implode(', ', array_values($arrayDados));

        $sql  = 'INSERT INTO ' . self::$tabela . ' (' . $campos . ') VALUES(' . $params . ');';
        return $sql;
    }


    # MONTA SQL DELETE
    public static function montaSQLDelete($arrayCondicoes){
        $sql  = 'DELETE FROM ' . self::$tabela;
        $sql .= ' WHERE ';

        foreach($arrayCondicoes as $key => $value):
            $sql .= " {$key} = :{$key} AND";
        endforeach;

        $sql = rtrim($sql, 'AND');

        return $sql;
    }

    # MONTA SQL UPDATE
    public static function montaSQLUpdate($arrayDados, $arrayCondicoes){
        $sql  = 'UPDATE ' . self::$tabela;
        $sql .= ' SET ';

        foreach($arrayDados as $key => $value):
            $sql .= " {$key} = {$value},";
        endforeach;

        $sql = rtrim($sql, ', ');

        $sql .= ' WHERE ';

        foreach($arrayCondicoes as $key => $value):
            $sql .= " {$key} = {$value} AND";
        endforeach;

        $sql  = rtrim($sql, 'AND');
        $sql .= ";";
        
        return $sql;
    }


    # SQL INSERT
    public static function insert($arrayDados){
        try{
            $sql = self::montaSQLInsert($arrayDados);
                    
            $stm = self::$conexao->prepare($sql);

            foreach($arrayDados as $key => $value):
                $stm->bindValue(':' . $key, $value);
            endforeach;

            $retorno = $stm->execute();
            return $retorno;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    # SQL DELETE
    public static function delete($arrayCondicoes){
        try{
            $sql = self::montaSQLDelete($arrayCondicoes);
            $stm = self::$conexao->prepare($sql);

            foreach($arrayCondicoes as $key => $value):
                $stm->bindValue(':' . $key, $value);
            endforeach;

            $retorno = $stm->execute();
            return $retorno;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }        
    }

    # SQL UPDATE
    public static function update($arrayDados, $arrayCondicoes){
        try{
            $sql = self::montaSQLUpdate($arrayDados, $arrayCondicoes);

            $stm = self::$conexao->prepare($sql);

            // Retirado pois dá erro: não há PARÂMETRO Bind
            // foreach($arrayDados as $key => $value):
            //     $stm->bindValue(':' . $key, $value);
            // endforeach;

            // foreach($arrayCondicoes as $key => $value):
            //     $stm->bindValue(':' . $key, $value);
            // endforeach;

            $retorno = $stm->execute();
            return $retorno;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }        
    }


    # SQL SELECT
    public static function select($sql, $arrayCondicoes, $fetchAll){
        try{
            $stm = self::$conexao->prepare($sql);

            foreach($arrayCondicoes as $key => $value):
                $stm->bindValue(':' . $key, $value);
            endforeach;

            $stm->execute();

            if ($fetchAll):
                return $stm->fetchAll(PDO::FETCH_OBJ);
            else:
                return $stm->fetch(PDO::FETCH_OBJ);
            endif;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }    
    }
}

// Para TESTES, mudar função para PUBLIC

// *********************** Montagem da STRING
// Crud::setTabela('tb_pessoa');
// echo Crud::montaSQLInsert(['nome' => 'Vinicius', 'cpf' => '123233233']);

// UPDATE
// Crud::setTabela('tb_pessoa');
// echo Crud::montaSQLUpdate(['id' => '12', 'tipo' => 'Juridico'],['id' => '20', 'tipo' => 'Fisica']);

// *********************** INSERT
// $pdo = Conexao::getConexao();
// Crud::setConexao($pdo);
// Crud::setTabela('tb_pessoa');

// $retorno = Crud::insert(['NOME' => 'ANDRE LUCIANO', 'EMAIL' => 'vinicius.luciano@gmail.com']);

// if ($retorno):
//     echo 'INCLUIDO';
// else:
//     echo 'PROBLEMA';
// endif;


// *********************** DELETE
// $pdo = Conexao::getConexao();
// Crud::setConexao($pdo);
// Crud::setTabela('tb_pessoa');

// $retorno = Crud::delete(['ID' => 3]);

// if ($retorno):
//     echo 'DELETADO';
// else:
//     echo 'PROBLEMA';
// endif;

// *********************** UPDATE
// $pdo = Conexao::getConexao();
// Crud::setConexao($pdo);
// Crud::setTabela('tb_pessoa');

// $retorno = Crud::update(['NOME' => 'DEMENTE'],['ID' => 4]);

// if ($retorno):
//     echo 'ATUALIZADO';
// else:
//     echo 'PROBLEMA';
// endif;


// *********************** SELECT
// $pdo = Conexao::getConexao();
// Crud::setConexao($pdo);

// $dados = Crud::select('SELECT * FROM tb_pessoa WHERE ID > :ID',
//                       ['ID' => 10],
//                       TRUE);

// echo '<pre>';
// var_dump($dados);
?>