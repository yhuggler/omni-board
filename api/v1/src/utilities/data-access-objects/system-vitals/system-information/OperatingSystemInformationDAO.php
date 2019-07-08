<?php

class OperatingSystemInformationDAO {
    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createOperatingSystemInformation(OperatingSystemInformation $operatingSystemInformation) {
        try {
            if (Validator::checkArrayForEmptyInput((array)$operatingSystemInformation)) {
                return false;
            }

            if ($this->checkIfOperatingSystemInformationExists($operatingSystemInformation->serverIdFk)) {
                return $this->updateOperatingSystemInformation($operatingSystemInformation);
            }

            $sql = "INSERT INTO operating_system_information(server_id_fk, platform, distro, os_release, codename, kernel, arch, hostname, codepage, logofile, serial, build, servicepack, updated_at) VALUES(:server_id_fk, :platform, :distro, :os_release, :codename, :kernel, :arch, :hostname, :codename, :logofile, :serial, :build, :servicepack, :updated_at)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $operatingSystemInformation->serverIdFk, PDO::PARAM_INT);
            $stmt->bindParam(':platform', $operatingSystemInformation->platform, PDO::PARAM_STR);
            $stmt->bindParam(':distro', $operatingSystemInformation->distro, PDO::PARAM_STR);
            $stmt->bindParam(':os_release', $operatingSystemInformation->release, PDO::PARAM_STR);
            $stmt->bindParam(':codename', $operatingSystemInformation->codename, PDO::PARAM_STR);
            $stmt->bindParam(':kernel', $operatingSystemInformation->kernel, PDO::PARAM_STR);
            $stmt->bindParam(':arch', $operatingSystemInformation->arch, PDO::PARAM_STR);
            $stmt->bindParam(':hostname', $operatingSystemInformation->hostname, PDO::PARAM_STR);
            $stmt->bindParam(':codepage', $operatingSystemInformation->codepage, PDO::PARAM_STR);
            $stmt->bindParam(':logofile', $operatingSystemInformation->logofile, PDO::PARAM_STR);
            $stmt->bindParam(':serial', $operatingSystemInformation->serial, PDO::PARAM_STR);
            $stmt->bindParam(':build', $operatingSystemInformation->build, PDO::PARAM_STR);
            $stmt->bindParam(':servicepack', $operatingSystemInformation->servicePack, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $operatingSystemInformation->updatedAt, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        } 
    }

    private function checkIfOperatingSystemInformationExists(int $serverId) {
        try {
            $sql = "SELECT * FROM operating_system_information WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetch();

            return !empty($result);
        } catch (Exception $e) {
            return false;
        } 
    }

    private function updateOperatingSystemInformation(OperatingSystemInformation $operatingSystemInformation) {
        try {
            $sql = "UPDATE operating_system_information SET platform = :platform,
                distro = :distro,
                os_release = :os_release,
                codename = :codename,
                kernel = :kernel,
                arch = :arch,
                hostname = :hostname,
                codepage = :codepage,
                logofile = :logofile,
                serial = :serial,
                build = :build,
                servicepack = :servicepack,
                updated_at = :updated_at
                WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $operatingSystemInformation->serverIdFk, PDO::PARAM_INT);
            $stmt->bindParam(':platform', $operatingSystemInformation->platform, PDO::PARAM_STR);
            $stmt->bindParam(':distro', $operatingSystemInformation->distro, PDO::PARAM_STR);
            $stmt->bindParam(':os_release', $operatingSystemInformation->release, PDO::PARAM_STR);
            $stmt->bindParam(':codename', $operatingSystemInformation->codename, PDO::PARAM_STR);
            $stmt->bindParam(':kernel', $operatingSystemInformation->kernel, PDO::PARAM_STR);
            $stmt->bindParam(':arch', $operatingSystemInformation->arch, PDO::PARAM_STR);
            $stmt->bindParam(':hostname', $operatingSystemInformation->hostname, PDO::PARAM_STR);
            $stmt->bindParam(':codepage', $operatingSystemInformation->codepage, PDO::PARAM_STR);
            $stmt->bindParam(':logofile', $operatingSystemInformation->logofile, PDO::PARAM_STR);
            $stmt->bindParam(':serial', $operatingSystemInformation->serial, PDO::PARAM_STR);
            $stmt->bindParam(':build', $operatingSystemInformation->build, PDO::PARAM_STR);
            $stmt->bindParam(':servicepack', $operatingSystemInformation->servicePack, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $operatingSystemInformation->updatedAt, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        } 
    }
    
    public function getOperatingSystemInformationByServerId($serverId) {
        try {
            $response = array();

            $sql = "SELECT * FROM operating_system_information WHERE server_id_fk = :server_id_fk";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id_fk', $serverId, PDO::PARAM_INT);

            $stmt->execute();
            
            $results = $stmt->fetchAll();

            if (!empty($results)) {
                $row = $results[0];

                $operatingSystemInformation = new OperatingSystemInformation();

                $operatingSystemInformation->setData($row['operating_system_information_id'],
                    $row['server_id_fk'],
                    $row['platform'],
                    $row['distro'],
                    $row['os_release'],
                    $row['codename'],
                    $row['kernel'],
                    $row['arch'],
                    $row['hostname'],
                    $row['codepage'],
                    $row['logofile'],
                    $row['serial'],
                    $row['build'],
                    $row['servicepack'],
                    $row['updated_at']);
        
                return $operatingSystemInformation;
            }

            return null;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteOperatingSystemInformationByServerId($serverId) {
        try {
            $response = array();

            $sql = "DELETE FROM operating_system_information WHERE server_id_fk = :server_id_fk";
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
