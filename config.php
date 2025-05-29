<?php
    // include classes
    require_once __DIR__ . '/classes/Email.php';
    require_once __DIR__ . '/classes/EmailStorage.php';

    // name of the file that we store data to
    // we want to use this information in different files 
    const STORAGE_FILE = __DIR__ . '/storage.txt';

    // instantiate email storage 
    $emailStorage = new EmailStorage(STORAGE_FILE);

?>