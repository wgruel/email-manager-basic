<?php
// Deletes an email entry from storage.txt based on the given email-address

include("config.php");

// Get the email address to delete from URL query parameter
$emailToDelete = $_GET['email'];

// Read all lines from the file
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Create a new array for filtered lines
$filteredLines = [];

foreach ($lines as $line) {
    // Compare current line with the email to delete
    if (trim($line) !== trim($emailToDelete)) {
        $filteredLines[] = $line;
    }
}

// Write updated lines back to file
$textToStore = "";
foreach ($filteredLines as $line) {
    $textToStore .= $line . "\n";
}
file_put_contents($filename, $textToStore);

// Redirect back to index
header('Location: index.php');
exit();
?>
