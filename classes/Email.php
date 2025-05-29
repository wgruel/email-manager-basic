<?php
class Email {
    private string $address;

    public function __construct(string $address) {
        $this->address = $address;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }
}
