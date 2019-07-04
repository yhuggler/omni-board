<?php

class Auth {

    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function hasCapability($capability, $user) {

    }
}

?>
