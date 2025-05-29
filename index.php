<?php
    require_once __DIR__ . '/config.php';
    $emails = $emailStorage->getAll();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email Address Manager</title>
    </head>
    <body>
        <h1>Email Address Manager - Welcome</h1>
        <h2>Saved Emails</h2>
        <?php
        // list all email adresses and generate links to edit/delete them
        foreach ($emails as $email){
            echo "<p>". $email->getAddress() . 
                " <a href='delete.php?email=" . $email->getAddress() . "'>Delete</a>" . 
                " <a href='edit.php?email=" . $email->getAddress() . "'>Edit</a>" . 
                "</p>\n\t";
        }
        ?>    
        <!-- Add link to a form to enter new email addresses --> 
        <h2>Add New Email</h2>
        <a href="insert.php">Add New Email</a>
    </body>
</html>

