<?php
class EmailStorage {
    private string $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
        // make sure that file exists
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, '');
        }
    }

    public function getAll() {
        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $emails = [];
        foreach ($lines as $idx => $line) {
            $emails[] = new Email(trim($line));
        }
        return $emails;
    }

    public function add($address) {
        file_put_contents($this->filePath, trim($address) . PHP_EOL, FILE_APPEND);
        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return new Email($address);
    }

    public function update($oldEmail, $newEmail) {
        // Read all lines, ignore new and empty lines
        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

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
        return file_put_contents($this->filePath, $textToStore);
    }

    public function delete($emailToDelete) {
        // Read all lines from the file
        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

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
        file_put_contents($this->filePath, $textToStore);

    }
}
