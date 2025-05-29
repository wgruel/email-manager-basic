<?php
    /**
     * Class EmailStorage
     *
     * This class manages the storage of email addresses using a simple text file.
     * It provides functionality to retrieve, add, update, and delete email entries.
     */
    class EmailStorage {

        /**
        * Variable that stores file location of data store
        */
        private string $filePath;

        /**
         * EmailStorage constructor.
         *
         * Ensures that the storage file exists. If it does not, it creates an empty file.
         *
         * @param string $filePath location of storage file
         */
        public function __construct($filePath) {
            $this->filePath = $filePath;
            // make sure that file exists
            if (!file_exists($this->filePath)) {
                file_put_contents($this->filePath, '');
            }
        }

        /**
         * Retrieves all stored email addresses.
         *
         * @return Email[] An array of Email objects representing the stored email addresses
         */
        public function getAll() {
            $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $emails = [];
            foreach ($lines as $line) {
                $emails[] = new Email(trim($line));
            }
            return $emails;
        }

        /**
         * Adds a new email address to the storage.
         *
         * @param string $address The email address to add
         * @return Email The Email object that was created and stored
         */
        public function add($address) {
            file_put_contents($this->filePath, trim($address) . PHP_EOL, FILE_APPEND);
            $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            return new Email($address);
        }

        /**
         * Updates an existing email address with a new one.
         *
         * @param string $oldEmail The email address to be replaced
         * @param string $newEmail The new email address to store
         * @return bool|int Returns the number of bytes written to the file, or false on failure
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
            return file_put_contents($this->filePath, $textToStore);
        }

        /**
         * Deletes an email address from the storage.
         *
         * @param string $emailToDelete The email address to be removed
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