<?php    
/**
 * File DOC
 * 
 * @Description Página de entrada para requisições do tipo GET, PUT, POST e DELETE para CHAT entre usuários
 * @ChangeLog 
 *  - Vinícius Lessa - 19/04/2022: Criação do arquivo e primeiras tratativas para receber a INCLUSÃO de anúncios via POST.
 *  - Vinícius Lessa - 26/04/2022: Reformulação da query de GET dos chats, pois estava com erro quando um mesmo POST tinha mais de um chat.
 * 
 * @ Tips & Tricks: 
 *      - To check the METHOD type use this: echo json_encode( ['verbo_http' => $_SERVER['REQUEST_METHOD']] );
 * 
 *  GET Method notes:
 *      - GET Url request example: .../trade_posts.php/?token={$token}&key={$key}&value={$value}
 * 
 */
 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-type: application/json; charset=UTF-8');

echo "Hello World!";

// project-fatec-soa.000webhostapp.com