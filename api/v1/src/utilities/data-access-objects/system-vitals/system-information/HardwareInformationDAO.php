<?php

class HardwareInformationDAO {
    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createHardwareInformation(HardwareInformation $hardwareInformation) {
        try {
            if (Validator::checkArrayForEmptyInput((array)$hardwareInformation)) {
                return false;
            }

            if ($this->checkIfHardwareInformationExists($hardwareInformation->serverIdFk)) {
                return $this->updateHardwareInformation($hardwareInformation);
            }

            $sql = "INSERT INTO hardware_information(server_id_fk, manufacturer, model, version, serial, uuid, sku, bios_vendor, bios_version, bios_release_date, bios_revision, updated_at) VALUES(:server_id_fk, :manufacturer, :model, :version, :serial, :uuid, :sku, :bios_vendor, :bios_version, :bios_release_date, :bios_revision, :updated_at)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $hardwareInformation->serverIdFk, PDO::PARAM_INT);
            $stmt->bindParam(':manufacturer', $hardwareInformation->manufacturer, PDO::PARAM_STR);
            $stmt->bindParam(':model', $hardwareInformation->model, PDO::PARAM_STR);
            $stmt->bindParam(':version', $hardwareInformation->version, PDO::PARAM_STR);
            $stmt->bindParam(':serial', $hardwareInformation->serial, PDO::PARAM_STR);
            $stmt->bindParam(':uuid', $hardwareInformation->uuid, PDO::PARAM_STR);
            $stmt->bindParam(':sku', $hardwareInformation->sku, PDO::PARAM_STR);
            $stmt->bindParam(':bios_vendor', $hardwareInformation->biosVendor, PDO::PARAM_STR);
            $stmt->bindParam(':bios_version', $hardwareInformation->biosVersion, PDO::PARAM_STR);
            $stmt->bindParam(':bios_release_date', $hardwareInformation->biosReleaseDate, PDO::PARAM_STR);
            $stmt->bindParam(':bios_revision', $hardwareInformation->biosRevision, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $hardwareInformation->updatedAt, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        } 
    }

    private function checkIfHardwareInformationExists(int $serverId) {
        try {
            $sql = "SELECT * FROM hardware_information WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetch();

            return !empty($result);
        } catch (Exception $e) {
            return false;
        } 
    }

    private function updateHardwareInformation(HardwareInformation $hardwareInformation) {
        try {
            $sql = "UPDATE hardware_information SET manufacturer = :manufacturer,
                model = :model,
                version = :version,
                serial = :serial,
                uuid = :uuid,
                sku = :sku,
                bios_vendor = :bios_vendor,
                bios_version = :bios_version,
                bios_release_date = :bios_release_date,
                bios_revision = :bios_revision,
                updated_at = :updated_at
                WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $hardwareInformation->serverIdFk, PDO::PARAM_INT);
            $stmt->bindParam(':manufacturer', $hardwareInformation->manufacturer, PDO::PARAM_STR);
            $stmt->bindParam(':model', $hardwareInformation->model, PDO::PARAM_STR);
            $stmt->bindParam(':version', $hardwareInformation->version, PDO::PARAM_STR);
            $stmt->bindParam(':serial', $hardwareInformation->serial, PDO::PARAM_STR);
            $stmt->bindParam(':uuid', $hardwareInformation->uuid, PDO::PARAM_STR);
            $stmt->bindParam(':sku', $hardwareInformation->sku, PDO::PARAM_STR);
            $stmt->bindParam(':bios_vendor', $hardwareInformation->biosVendor, PDO::PARAM_STR);
            $stmt->bindParam(':bios_version', $hardwareInformation->biosVersion, PDO::PARAM_STR);
            $stmt->bindParam(':bios_release_date', $hardwareInformation->biosReleaseDate, PDO::PARAM_STR);
            $stmt->bindParam(':bios_revision', $hardwareInformation->biosRevision, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $hardwareInformation->updatedAt, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        } 
    }

    public function getHardwareInformationByServerId($serverId) {
        try {
            $response = array();

            $sql = "SELECT * FROM hardware_information WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll();

            if (!empty($results)) {
                $row = $results[0];

                $hardwareInformation = new HardwareInformation();

                $hardwareInformation->setData($row['hardware_information_id'],
                    $row['server_id_fk'],
                    $row['manufacturer'],
                    $row['model'],
                    $row['version'],
                    $row['serial'],
                    $row['uuid'],
                    $row['sku'],
                    $row['bios_vendor'],
                    $row['bios_version'],
                    $row['bios_release_date'],
                    $row['bios_revision'],
                    $row['updated_at']);


                return $hardwareInformation;
            }
            
            return null; 
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteHardwareInformationByServerId($serverId) {
        try {
            $response = array();

            $sql = "DELETE FROM hardware_information WHERE server_id_fk = :server_id_fk";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>
