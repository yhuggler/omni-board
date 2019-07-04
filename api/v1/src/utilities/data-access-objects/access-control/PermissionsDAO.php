<?php

class PermissionsDAO {

    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createCapabilities(Capability $capability) {
        
    }

}

?>
