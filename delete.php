<?php
    // Deletes an email entry from storage.txt based on the given email-address

    require_once __DIR__ . '/config.php';

    // Get the email address to delete from URL query parameter
    $emailToDelete = $_GET['email'];

    $emailStorage->delete($emailToDelete);
    // Redirect back to index
    header('Location: index.php');
    exit();
?>
