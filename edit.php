<?php
    require_once __DIR__ . '/config.php';

    if (isset($_POST['btn-save'])) {
        $oldEmail = trim($_POST['oldEmail']);
        $newEmail = trim($_POST['newEmail']);
        $emailStorage->update($oldEmail, $newEmail);

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
