<?php
include("config.php");

if (isset($_POST['btn-save'])) {
    $oldEmail = trim($_POST['oldEmail']);
    $newEmail = trim($_POST['newEmail']);

    // Read all lines, ignore new and empty lines
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $updatedList = [];
    // Replace old email with new one
    foreach ($lines as $line) {
        if (trim($line) == $oldEmail) {
            $updatedList[] = $newEmail; 
        }
        else {
            $updatedList[] = $line;
        }
    }

    // Write updated lines back to file
    $textToStore = "";
    foreach ($updatedList as $line) {
        $textToStore .= $line . "\n";
    }
    file_put_contents($filename, $textToStore);

    // Redirect back to main page
    header('Location: index.php');
    exit();
}

$oldEmail = $_GET['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Address Manager</title>
</head>
<body >
    <h1>Email Address Manager - Edit Email</h1>
    <!-- Edit form -->
    <form method="post">
        <input type="hidden" name="oldEmail" value="<?php echo $oldEmail ?>">
        <input type="email" name="newEmail" value="<?php echo trim($oldEmail) ?>" required>
        <button type="submit" name="btn-save">Update</button>
    </form>
</body>
</html>
