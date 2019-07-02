<?php

class VitalsDAO {
    private $cpuReadingDAO;
    private $systemStatsDAO;
    private $serverDAO;

    public function __construct() {
        $this->cpuReadingDAO = new CpuReadingDAO();
        $this->systemStatsDAO = new SystemStatsDAO();
        $this->serverDAO = new ServerDAO();
    }

    public function createVitalsReading(Vitals $vitals) {
        try {
            $response = array();
            
            if (!$this->cpuReadingDAO->createCpuReading($vitals->cpuReading)) {
                $response['error'] = Errors::BAD_REQUEST;
                return $response;
            }
            
            if (!$this->systemStatsDAO->createSystemStats($vitals->systemStats)) {
                $response['error'] = Errors::BAD_REQUEST;
                return $response;
            }

            $response['message'] = "200 | OK - The vitals reading was created successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }

    public function getVitalReadings() {
        try {
            $response = array();

            $servers = $this->serverDAO->getServers()['servers'];

            foreach ($servers as $server) {
                $vitals = array();

                $vitals['server'] = $server;
                $vitals['cpuReadings'] = $this->cpuReadingDAO->getCpuReadingsByServerId($server->serverId);
                $vitals['systemStats'] = $this->systemStatsDAO->getSystemStatsByServerId($server->serverId);

                array_push($response, $vitals);
            }

            return $response; 
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function deleteVitalReadingsByServerId($serverId) {
        try {
            $response = array();

            if (!$this->cpuReadingDAO->deleteCpuReadingsByServerId($serverId)) {
                $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
                return $response;
            }
            
            if (!$this->systemStatsDAO->deleteSystemStatsByServerId($serverId)) {
                $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
                return $response;
            }

            $response['message'] = "200 | OK - The vital readings were deleted successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
}

?>
