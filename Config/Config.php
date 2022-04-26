<?php namespace Config;

    define("ROOT", dirname(__DIR__) . "/");
    define("FRONT_ROOT", "/Labo4/TPL4copy/");
    define("VIEWS_PATH", "Views/");
    define("UPLOADS_PATH", "Uploads/");
    define("PDF_PATH", "dompdf/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
    
    define("DB_HOST", "127.0.0.1");
    define("DB_NAME", "labo4");
    define("DB_USER", "root");
    define("DB_PASS", "admin");
?>    