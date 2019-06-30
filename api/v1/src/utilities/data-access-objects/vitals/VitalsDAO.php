<?php

class VitalsDAO {
    private $cpuReadingDAO;
    private $gpuReadingDAO;
    private $systemStatsDAO;

    public function __construct() {
        $this->cpuReadingDAO = new CpuReadingDAO();
        $this->gpuReadingDAO = new GpuReadingDAO();
        $this->systemStatsDAO = new SystemStatsDAO();
    }

    public function createVitalsReading(Vitals $vitals) {
        try {
            $response = array();
            
            if (!$this->cpuReadingDAO->createCpuReading($vitals->cpuReading)) {
                $response['error'] = Errors::BAD_REQUEST;
                return $response;
            }
            
            if (!$this->gpuReadingDAO->createGpuReading($vitals->gpuReading)) {
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
}

?>
