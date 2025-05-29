<?php
    // autoload all the classes that are stores in app...
    spl_autoload_register(function(string $class) {
        $paths = [
            __DIR__ . '/app/Controllers/' . $class . '.php',
            __DIR__ . '/app/Models/'      . $class . '.php',
        ];
        foreach ($paths as $file) {
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    });

    // name of the file that we store data to
    // we want to use this information in different files 
    const STORAGE_FILE = __DIR__ . '/storage.txt';

?>