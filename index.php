<?php
    include('config.php');
    // get content of $filename 
    // each line will be stored as element of 
    // array $text
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Address Manager</title>
</head>
<body >
    <h1>Email Address Manager - Welcome</h1>
    <h2>Saved Emails</h2>
    <?php
    foreach ($lines as $line){
        echo "<p>". $line . 
            " <a href='delete.php?email=" . $line . "'>Delete</a>" . 
            " <a href='edit.php?email=" . $line . "'>Edit</a>" . 
            "</p>\n\t";
    }
    ?>    
    <!-- Add link that leads us to a form to enter new email addresses --> 
    <h2>Add New Email</h2>
    <a href="insert.php">Add New Email</a>

</body>

</html>
