<?php

class VitalsDAO {
    private $cpuReadingDAO;
    private $gpuReadingDAO;

    public function __construct() {
        $this->cpuReadingDAO = new CpuReadingDAO();
        // $this->gpuReadingDAO = new GpuReadingDAO();
    }

    public function createVitalsReading(Vitals $vitals) {
        try {
            $response = array();
            
            $createdAt = time();        

            $this->cpuReadingDAO->createCpuReading($vitals->cpuReading);

        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return $response;
        } 
    }
}

?>
