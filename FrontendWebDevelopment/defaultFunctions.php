<?php
/**
 * File DOC
 * 
 * @Description Funções PHP chamadas em mais de um trecho do Site.
 * @ChangeLog 
 *  - Vinícius Lessa - 02/05/2022: Criação do arquivo e Inclusão da documentação de cabeçalho do mesmo. Criação da função 'validateImageSource()'
 * 
 * @ Notes: 
 * 
 */

function validateImageSource($imageUrl) {

    $file = $imageUrl;
    $file_headers = @get_headers($file);

    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'):
        return false;
    else: 
        return true;
    endif;    
}

?>