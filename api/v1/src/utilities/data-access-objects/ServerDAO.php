<?php

class ServerDAO {
    private $conn;
    private $authKeyManager;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;

        $this->authKeyManager = new AuthKeyManager();
    }

    public function createServer($server) {
        try {
            $response = array();

            $sql = "INSERT INTO servers(friendly_name, description) VALUES(:friendlyName, :description)"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':friendlyName', $server->friendlyName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $server->description, PDO::PARAM_STR);
            $stmt->execute();

            $serverId = $this->conn->lastInsertId();
            $authKey = $this->authKeyManager->generateAuthKey($serverId);

            $response['server'] = new Server($serverId, $server->friendlyName, $server->description, $authKey);
            $response['message'] = "The server has been added successfully.";

            return $response;
        } catch (Exception $e) {
            LoggerHelper::log(LoggingLevels::SEVERE, $e->getMessage());
            $response['error'] = $e->getMessage();
            return $response;
        } 
    } 

    public function getServers() {
        try {
            $response = array();

            $sql = "SELECT * FROM servers INNER JOIN auth_keys ON servers.server_id = auth_keys.server_id"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $response['servers'] = array();

            foreach ($stmt as $row) {
                $authKey = array(
                    "authKeyId" => $row['auth_key_id'],
                    "authKey" => $row['auth_key']
                );

                $server = new Server($row['server_id'], $row['friendly_name'], $row['description'], $authKey);
                array_push($response['servers'], $server);
            }

            return $response;
        } catch (Exception $e) {
            LoggerHelper::log(LoggingLevels::SEVERE, $e->getMessage());
            $response['error'] = $e->getMessage();
            return $response;
        } 
    }

    public function getServerById($serverId) {
        try {
            $response = array();

            $sql = "SELECT * FROM servers INNER JOIN auth_keys ON servers.server_id = auth_keys.server_id WHERE servers.server_id = :serverId"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':serverId', $serverId, PDO::PARAM_INT);
            $stmt->execute();

            $serverResultSet = $stmt->fetchAll();

            if (!empty($serverResultSet)) {
                $row = $serverResultSet[0];

                $authKey = array(
                    "authKeyId" => $row['auth_key_id'],
                    "authKey" => $row['auth_key']
                );

                $response['server'] = new Server($row['server_id'], $row['friendly_name'], $row['description'], $authKey);
            } else {
                $response['error'] = "There is no server with this id.";
            }

            return $response;
        } catch (Exception $e) {
            LoggerHelper::log(LoggingLevels::SEVERE, $e->getMessage());
            $response['error'] = $e->getMessage();
            return $response;
        } 
    }

    public function updateServer($server) {
        try {
            $response = array();

            $sql = "UPDATE servers SET friendly_name = :friendlyName, description = :description WHERE server_id = :serverId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':friendlyName', $server->friendlyName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $server->description, PDO::PARAM_STR);
            $stmt->bindParam(':serverId', $server->serverId, PDO::PARAM_INT);
            $stmt->execute();

            $response['server'] = $this->getServerById($server->serverId);
            $response['message'] = "The server was updated successfully!";

            return $response;
        } catch (Exception $e) {
            LoggerHelper::log(LoggingLevels::SEVERE, $e->getMessage());
            $response['error'] = $e->getMessage();
            return $response;
        }
    }

    public function deleteServer($serverId) {
        try {
            $response = array();

            $sql = "DELETE FROM servers WHERE server_id = :serverId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':serverId', $server->serverId, PDO::PARAM_INT);
            $stmt->execute();

            $response['message'] = "The server was deleted successfully!";

            return $response;
        } catch (Exception $e) {
            LoggerHelper::log(LoggingLevels::SEVERE, $e->getMessage());
            $response['error'] = $e->getMessage();
            return $response;
        }
    }
}

?>
