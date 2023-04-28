<?php
spl_autoload_register(function ($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filename = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
    if (file_exists($filename)) {
        require $filename;
    } else {
        exit('File <b>' . $filename . ' </b> not found in predefined directories');
    }
});