<?php
    class User {
        public $id;
        public $username;
        public $role;

        public function __construct(int $id, string $username, int $role) {
            $this->id = $id;
            $this->username = $username;
            $this->role = $role;
        } 
    }
?>
