<?php

class LogDAO {
    public function __construct() {
        
    }

    public function createLog($loggingLevel, $message) {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestURI = $_SERVER['REQUEST_URI'];
        $client = $_SERVER['HTTP_USER_AGENT'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        
        
    }

    public function getLogs() {

    }

    public function deleteLogs() {

    }
}

?>
