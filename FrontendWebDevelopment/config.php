<?php
    error_reporting(0); // No Errors Displayed    
            
    // MAMP
    $backEndBaseURL = "http://localhost/TG_MTC/BackendDevelopment";

    $frontDir = "/TG_MTC/FrontEndWebDevelopment";
    define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].$frontDir);
    
    // WEB
    // $backEndBaseURL = "https://musictradecenter.000webhostapp.com/BackendDevelopment";

    // $frontDir = "";
    // define('SITE_URL', 'https://'.$_SERVER['HTTP_HOST'].$frontDir);

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', $_SERVER['DOCUMENT_ROOT']);
    define('SITE_ROOT', ROOT.$frontDir);
    define('SITE_PATH', ROOT.$frontDir);    
	define('BACKEND_URL', $backEndBaseURL);
?>