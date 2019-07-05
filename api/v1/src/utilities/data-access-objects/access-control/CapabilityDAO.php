<?php

class CapabilityDAO {

    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createCapability(Capability $capability) {
        try {
            $response = array();

            if (Validator::checkArrayForEmptyInput((array)$capability)) {
                $response['error'] = Validator::checkArrayForEmptyInput((array)$capability);
                return $response;
            }

            $sql = "INSERT INTO capabilities(capability) VALUES(:capability)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':capability', $capability->capability, PDO::PARAM_STR);
            $stmt->execute();

            $response['message'] = "200 | OK - The capability was created successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function getCapabilities() {
        try {
            $response['capabilities'] = array();

            $sql = "SELECT * FROM capabilities ORDER BY capability_id ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            foreach ($stmt as $row) {
                $capability = new Capability($row['capability_id'], $row['capability']);
                array_push($response['capabilities'], $capability);
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }   
    }

    public function updateCapability(Capability $capability) {
        try {
            $response = array();

            if (Validator::checkArrayForEmptyInput((array)$capability)) {
                $response['error'] = Validator::checkArrayForEmptyInput((array)$capability);
                return $response;
            }

            $sql = "UPDATE capabilities SET capability = :capability WHERE capability_id = :capability_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':capability_id', $capability->capabilityId, PDO::PARAM_INT);
            $stmt->bindParam(':capability', $capability->capability, PDO::PARAM_STR);
            $stmt->execute();

            $response['message'] = "200 | OK - The capability was updated successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function deleteCapability(int $capabilityId) {
        try {
            $response = array();

            $sql = "DELETE FROM capabilities WHERE capability_id = :capability_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':capability_id', $capabilityId, PDO::PARAM_INT);
            $stmt->execute();

            $response['message'] = "200 | OK - The capability was deleted successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }
}

?>
