<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email Address Manager</title>
    </head>
    <body >
        <h1>Email Address Manager - Add New Email</h1>
        <!-- Input form -->
        <form method="post" action="index.php?action=insert">
            <input type="email" name="email" placeholder="Enter email" required>
            <button type="submit" name="btn-save" value="1">Save Email</button>
        </form>
        <p><a href="index.php?action=index">Zurück zur Liste</a></p>
    </body>
</html>



