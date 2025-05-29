<?php
    /**
     * Class EmailStorage
     *
     * Manages storage of email addresses using a flat text file as a simple database.
     * Each email address is stored on a separate line.
     *
     * This class provides methods to:
     * - Load all stored email addresses
     * - Add new email addresses
     * - Update existing ones
     * - Delete specific addresses
     *
     * It demonstrates basic file operations in PHP and simple persistence logic.
     */
    class EmailStorage {

        /**
         * @var string Location of text file used for storing emails
         */        
        private string $filePath;

        /**
         * EmailStorage constructor.
         *
         * Initializes the storage location and ensures the file exists.
         *
         * @param string $filePath The location to the file where emails are stored
         */
        public function __construct($filePath) {
            $this->filePath = $filePath;
            // make sure that file exists
            if (!file_exists($this->filePath)) {
                file_put_contents($this->filePath, '');
            }
        }

        /**
         * Retrieves all email addresses stored in the file.
         *
         * @return Email[] An array of Email objects, one for each address stored
         */        
        public function getAll() {
            $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $emails = [];
            foreach ($lines as $idx => $line) {
                $emails[] = new Email(trim($line));
            }
            return $emails;
        }

        /**
         * Adds a new email address to the storage.
         *
         * @param string $address The email address to add
         * @return Email The newly created Email object
         */        
        public function add($address) {
            file_put_contents($this->filePath, trim($address) . PHP_EOL, FILE_APPEND);
            $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            return new Email($address);
        }

        /**
         * Updates an existing email address by replacing it with a new one.
         *
         * @param string $oldEmail The existing email address to be replaced
         * @param string $newEmail The new email address to replace the old one
         */        
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
            file_put_contents($this->filePath, $textToStore);
        }

        /**
         * Deletes an email address from the storage.
         *
         * @param string $emailToDelete The email address to remove
         * @return void
         */        
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
?>