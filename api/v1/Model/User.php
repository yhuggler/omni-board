<?php
    class User {
        public $id;
        public $username;
    
        public function __construct(int $id, string $username) {
            $this->id = $id;
            $this->username = $username;
        } 
    }
?>
