<?php
/**
 * File DOC
 * 
 * @Description Classe que possui o Método para Consulta de CEPS online
 * 
 * @ChangeLog 
 *  - Vinícius Lessa - 04/05/2022: Implementação da Nova Classe.
 */

// namespace classes\WebServices;

class ViaCEP{

    /**
     * Método responsável por Constultar um CEP no ViaCep
     * @param string $cep
     * @return array
     */

    public static function consultarCEP($cep) {
        // Inicia Curl
        $curl = curl_init();

        // Configuração do Curl
        curl_setopt_array($curl, [
            CURLOPT_URL => 'viacep.com.br/ws/' . $cep . '/json/ ' ,
            CURLOPT_RETURNTRANSFER => true ,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        // Response
        $response = curl_exec($curl);

        // Fecha a Conexão Aberta
        curl_close($curl);

        // Converte o JSON para Array
        $a_Response = json_decode($response, true);

        return isset($a_Response['cep']) ? $a_Response : null;
    }


}