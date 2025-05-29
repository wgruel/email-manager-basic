<?php
    /**
     * Class Email
     *
     * Represents a single email address. This class provides basic encapsulation
     * for working with email data.
     * Usually, there would be more information like an id and a name. But we
     * keep things simple.
     */
    class Email {
        /**
         * @var string The email address
         */        
        private $address;

        /**
         * Email constructor.
         *
         * Initializes the email object with the provided address.
         *
         * @param string $address The email address to be stored
         */        
        public function __construct($address) {
            $this->address = $address;
        }

        /**
         * Returns the email address stored in this object.
         *
         * @return string The email address
         */        
        public function getAddress() {
            return $this->address;
        }

        /**
         * Updates the email address stored in this object.
         *
         * @param string $address The new email address to store
         * @return void
         */        
        public function setAddress(string $address) {
            $this->address = $address;
        }
}
