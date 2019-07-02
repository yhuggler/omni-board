<?php

class SystemInformationDAO {

    private $cpuInformationDAO;
    private $hardwareInformationDAO;
    private $operatingSystemInformationDAO;
    private $serverDAO;

    public function __construct() {
        $this->cpuInformationDAO = new CpuInformationDAO();
        $this->hardwareInformationDAO = new HardwareInformationDAO();
        $this->operatingSystemInformationDAO = new OperatingSystemInformationDAO();
        $this->serverDAO = new ServerDAO();
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
            
            if (!$this->operatingSystemInformationDAO->createOperatingSystemInformation($systemInformation->operatingSystemInformation)) {
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

    public function getSystemInformationEntries() {
        try {
            $response = array();

            $servers = $this->serverDAO->getServers()['servers'];

            foreach ($servers as $server) {
                $systemInformation = array(); 

                $systemInformation['server'] = $server;
                $systemInformation['cpuInformation'] = $this->cpuInformationDAO->getCpuInformationByServerId($server->serverId);
                $systemInformation['hardwareInformation'] = $this->hardwareInformationDAO->getHardwareInformationByServerId($server->serverId);
                $systemInformation['operatingSystemInformation'] = $this->operatingSystemInformationDAO->getOperatingSystemInformationByServerId($server->serverId);

                array_push($response, $systemInformation);
            }

            return $response; 
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }

    } 

}

?>

