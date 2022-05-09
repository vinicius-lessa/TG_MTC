<?php
    $isLocal = true;
        
    if ( $isLocal ):
        // Definir abaixo a partir do caminho do ROOT do Apache Server até a ROOT do projeto. Ex.: htdocs -> /TG_MTC/BackendDevelopment
        $dir = "/TG_MTC/BackendDevelopment";
        
        define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].$dir); // http://localhost/TG_MCT/BackendDevelopment/
    else:        
        
        define('SITE_URL', 'https://'.$_SERVER['HTTP_HOST']); // https://www.musictradecenter.com/
    endif;    

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', $_SERVER['DOCUMENT_ROOT']);
    define('SITE_ROOT', ROOT.$dir);
    define('SITE_PATH', ROOT.$dir);    
?>