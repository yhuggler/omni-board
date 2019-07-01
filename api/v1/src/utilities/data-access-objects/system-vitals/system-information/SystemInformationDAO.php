<?php

class SystemInformationDAO {

    private $cpuInformationDAO;

    public function __construct() {
        $this->cpuInformationDAO = new CpuInformationDAO();
        $this->hardwareInformationDAO = new HardwareInformationDAO();
    }

    public function createSystemInformationEntry(SystemInformation $systemInformation) {
        try {
            $response = array();

            if (!$this->cpuInformationDAO->createCpuInformation($systemInformation->cpuInformation)) {
                $response['error'] = Errors::BAD_REQUEST;
                return $response;
            }
            
            if (!$this->hardwareInformationDAO->createHardwareInformation($systemInformation->hardwareInformation)) {
                $response['error'] = Errors::BAD_REQUEST;
                return $response;
            }
                    
            $response['message'] = "200 | OK - The systeminformation entry was created successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }
}

?>

