<?php

class SystemInformationDAO {

    public function __construct() {
    }

    public function createSystemInformationEntry(SystemInformation $systemInformation) {
        try {
            $response = array();
            
            $response['message'] = "200 | OK - The systeminformation entry was created successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }
}

?>

