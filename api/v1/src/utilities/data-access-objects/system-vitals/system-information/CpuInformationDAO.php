<?php

class CpuInformationDAO {
    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createCpuInformation(CpuInformation $cpuInformation) {
        try {
            if (Validator::checkArrayForEmptyInput((array)$cpuInformation)) {
                return false;
            }

            if ($this->checkIfCpuInformationExists($cpuInformation->serverIdFk)) {
                return $this->updateCpuInformation($cpuInformation);
            }

            $sql = "INSERT INTO cpu_information(server_id_fk, manufacturer, brand, speed_min, speed_max, cores, physical_cores, processors, socket, vendor, family, model, stepping, revision, voltage, updated_at) VALUES(:server_id_fk, :manufacturer, :brand, :speed_min, :speed_max, :cores, :physical_cores, :processors, :socket, :vendor, :family, :model, :stepping, :revision, :voltage, :updated_at)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $cpuInformation->serverIdFk, PDO::PARAM_INT);
            $stmt->bindParam(':manufacturer', $cpuInformation->manufacturer, PDO::PARAM_STR);
            $stmt->bindParam(':brand', $cpuInformation->brand, PDO::PARAM_STR);
            $stmt->bindParam(':speed_min', $cpuInformation->speedMin, PDO::PARAM_STR);
            $stmt->bindParam(':speed_max', $cpuInformation->speedMax, PDO::PARAM_STR);
            $stmt->bindParam(':cores', $cpuInformation->cores, PDO::PARAM_INT);
            $stmt->bindParam(':physical_cores', $cpuInformation->physicalCores, PDO::PARAM_INT);
            $stmt->bindParam(':processors', $cpuInformation->processors, PDO::PARAM_INT);
            $stmt->bindParam(':socket', $cpuInformation->socket, PDO::PARAM_STR);
            $stmt->bindParam(':vendor', $cpuInformation->vendor, PDO::PARAM_STR);
            $stmt->bindParam(':family', $cpuInformation->family, PDO::PARAM_STR);
            $stmt->bindParam(':model', $cpuInformation->model, PDO::PARAM_STR);
            $stmt->bindParam(':stepping', $cpuInformation->stepping, PDO::PARAM_STR);
            $stmt->bindParam(':revision', $cpuInformation->revision, PDO::PARAM_STR);
            $stmt->bindParam(':voltage', $cpuInformation->voltage, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $cpuInformation->updatedAt, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        } 
    }

    private function checkIfCpuInformationExists(int $serverId) {
        try {
            $sql = "SELECT * FROM cpu_information WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetch();

            return !empty($result);
        } catch (Exception $e) {
            return false;
        } 
    }

    private function updateCpuInformation(CpuInformation $cpuInformation) {
        try {
            $sql = "UPDATE cpu_information SET manufacturer = :manufacturer, 
                brand = :brand,
                speed_min = :speed_min,
                speed_max = :speed_max,
                cores = :cores,
                physical_cores = :physical_cores,
                processors = :processors,
                socket = :socket,
                vendor = :vendor,
                family = :family,
                model = :model,
                stepping = :stepping,
                revision = :revision,
                voltage = :voltage,
                updated_at = :updated_at
                WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $cpuInformation->serverIdFk, PDO::PARAM_INT);
            $stmt->bindParam(':manufacturer', $cpuInformation->manufacturer, PDO::PARAM_STR);
            $stmt->bindParam(':brand', $cpuInformation->brand, PDO::PARAM_STR);
            $stmt->bindParam(':speed_min', $cpuInformation->speedMin, PDO::PARAM_STR);
            $stmt->bindParam(':speed_max', $cpuInformation->speedMax, PDO::PARAM_STR);
            $stmt->bindParam(':cores', $cpuInformation->cores, PDO::PARAM_INT);
            $stmt->bindParam(':physical_cores', $cpuInformation->physicalCores, PDO::PARAM_INT);
            $stmt->bindParam(':processors', $cpuInformation->processors, PDO::PARAM_INT);
            $stmt->bindParam(':socket', $cpuInformation->socket, PDO::PARAM_STR);
            $stmt->bindParam(':vendor', $cpuInformation->vendor, PDO::PARAM_STR);
            $stmt->bindParam(':family', $cpuInformation->family, PDO::PARAM_STR);
            $stmt->bindParam(':model', $cpuInformation->model, PDO::PARAM_STR);
            $stmt->bindParam(':stepping', $cpuInformation->stepping, PDO::PARAM_STR);
            $stmt->bindParam(':revision', $cpuInformation->revision, PDO::PARAM_STR);
            $stmt->bindParam(':voltage', $cpuInformation->voltage, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $cpuInformation->updatedAt, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        } 
    }

    public function getCpuInformationByServerId($serverId) {
        try {
            $response = array();

            $sql = "SELECT * FROM cpu_information WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            foreach ($stmt as $row) {
                $cpuInformation = new CpuInformation();

                $cpuInformation->setData($row['cpu_information_id'],
                    $row['server_id_fk'],
                    $row['manufacturer'],
                    $row['brand'],
                    $row['speed_min'],
                    $row['speed_max'],
                    $row['cores'],
                    $row['physical_cores'],
                    $row['processors'],
                    $row['socket'],
                    $row['vendor'],
                    $row['family'],
                    $row['model'],
                    $row['stepping'],
                    $row['revision'],
                    $row['voltage'],
                    $row['updated_at']);

                array_push($response, $cpuInformation);
            }

            return $response;
        } catch (Exception $e) {
            return false;
        }
    }
}

?>

