<?php

// Definir abaixo a partir do caminho do ROOT do Apache Server até a ROOT do projeto. Ex.: htdocs -> /TG_MTC/FrontEndWebDevelopment
$dir = "/TG_MTC/FrontEndWebDevelopment";

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SITE_ROOT', ROOT.$dir);
define('SITE_PATH', ROOT.$dir);
define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].$dir); // Resultado: http://localhost/TG_MCT/FrontEndWebDevelopment