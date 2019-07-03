<?php

class CpuReadingDAO {
    private $conn;
    private $MAX_LIMIT_OF_READINGS = 10;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createCpuReading(CpuReading $cpuReading) {
        try {
            if ($this->checkIfLimitIsExceeded($cpuReading->serverIdFk)) {
                if (!$this->archiveOldestCpuReadingByServerId($cpuReading->serverIdFk))
                    return false;
            }
            
            if (Validator::checkArrayForEmptyInput((array)$cpuReading)) {
                return false;
            }

            $sql = "INSERT INTO cpu_readings(current_load, current_clockspeed, 
                current_temp, created_at, server_id_fk) VALUES(:current_load, :current_clockspeed,
                :current_temp, :created_at, :server_id_fk)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':current_load', $cpuReading->currentLoad, PDO::PARAM_STR);
            $stmt->bindParam(':current_clockspeed', $cpuReading->currentClockspeed, PDO::PARAM_STR);
            $stmt->bindParam(':current_temp', $cpuReading->currentTemp, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $cpuReading->createdAt, PDO::PARAM_INT);
            $stmt->bindParam(':server_id_fk', $cpuReading->serverIdFk, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }

    public function getCpuReadingsByServerId($serverId) {
        try {
            $response = array();

            $sql = "SELECT * FROM cpu_readings WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            foreach ($stmt as $row) {
                $cpuReading = new CpuReading();

                $cpuReading->setData($row['cpu_reading_id'],
                    $row['current_load'],
                    $row['current_clockspeed'],
                    $row['current_temp'],
                    $row['created_at'],
                    $row['server_id_fk']);

                array_push($response, $cpuReading);
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }

    public function getArchivedCpuReadingsByServerId($serverId) {
        try {
            $response = array();

            $sql = "SELECT * FROM archived_cpu_readings WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            foreach ($stmt as $row) {
                $cpuReading = new CpuReading();

                $cpuReading->setData($row['cpu_reading_id'],
                    $row['current_load'],
                    $row['current_clockspeed'],
                    $row['current_temp'],
                    $row['created_at'],
                    $row['server_id_fk']);

                array_push($response, $cpuReading);
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }

    public function deleteCpuReadingsByServerId($serverId) {
        try {
            $response = array();

            $sql = "DELETE FROM cpu_readings WHERE server_id_fk = :server_id_fk";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function deleteArchivedCpuReadingsByServerId($serverId) {
        try {
            $response = array();

            $sql = "DELETE FROM archived_cpu_readings WHERE server_id_fk = :server_id_fk";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function checkIfLimitIsExceeded($serverId) {
        try {
            $sql = "SELECT * FROM cpu_readings WHERE server_id_fk = :server_id_fk";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll();

            return sizeof($results) >= $this->MAX_LIMIT_OF_READINGS;
        } catch (Exception $e) {
            return false;
        }
    }

    private function archiveOldestCpuReadingByServerId($serverId) {
        try {
            $sql = "INSERT INTO archived_cpu_readings(current_load, current_clockspeed, current_temp, created_at, server_id_fk) SELECT current_load, current_clockspeed, current_temp, created_at, server_id_fk FROM cpu_readings WHERE server_id_fk = :server_id_fk ORDER BY created_at ASC LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            $sql = "DELETE FROM cpu_readings WHERE server_id_fk = :server_id_fk ORDER BY created_at ASC LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (Exception $e) {

            echo $e->getMessage();
            return false;
        }
    }
}

?>
