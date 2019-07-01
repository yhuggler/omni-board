<?php

class GpuReadingDAO {
    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createGpuReading(GpuReading $gpuReading) {
        try {
            if (Validator::checkArrayForEmptyInput((array)$gpuReading)) {
                return false;
            }

            $sql = "INSERT INTO gpu_readings(current_load, current_clockspeed, max_clockspeed, 
                min_clockspeed, current_temp, memory_clock_speed, created_at, 
                server_id_fk) VALUES(:current_load, :current_clockspeed, :max_clockspeed, 
                :min_clockspeed, :current_temp, :memory_clock_speed, :created_at, :server_id_fk)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':current_load', $gpuReading->currentLoad, PDO::PARAM_STR);
            $stmt->bindParam(':current_clockspeed', $gpuReading->currentClockspeed, PDO::PARAM_STR);
            $stmt->bindParam(':max_clockspeed', $gpuReading->maxClockspeed, PDO::PARAM_STR);
            $stmt->bindParam(':min_clockspeed', $gpuReading->minClockspeed, PDO::PARAM_STR);
            $stmt->bindParam(':current_temp', $gpuReading->currentTemp, PDO::PARAM_STR);
            $stmt->bindParam(':memory_clock_speed', $gpuReading->memoryClockspeed, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $gpuReading->createdAt, PDO::PARAM_INT);
            $stmt->bindParam(':server_id_fk', $gpuReading->serverIdFk, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }

    public function getGpuReadingByServerId($serverId) {
        try {
            $response = array();

            $sql = "SELECT * FROM gpu_readings WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverIdFk, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }
}

?>
