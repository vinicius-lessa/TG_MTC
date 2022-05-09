<?php

    error_reporting(0);
    
    // Definir abaixo a partir do caminho do ROOT do Apache Server até a ROOT do projeto. Ex.: htdocs -> /TG_MTC/FrontEndWebDevelopment
    $frontDir = "/TG_MTC/FrontEndWebDevelopment";
	
	$backBase = "http://localhost/TG_MTC/BackendDevelopment";
	// $backBase = "https://mtc-backend.herokuapp.com";

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', $_SERVER['DOCUMENT_ROOT']);
    define('SITE_ROOT', ROOT.$frontDir);
    define('SITE_PATH', ROOT.$frontDir);
    define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].$frontDir); // Resultado: http://localhost/TG_MCT/FrontEndWebDevelopment
	define('BACKEND_URL', $backBase); // Resultado: http://localhost/TG_MCT/FrontEndWebDevelopment
?>