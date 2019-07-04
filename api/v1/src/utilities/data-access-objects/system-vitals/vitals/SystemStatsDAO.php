<?php

class SystemStatsDAO {
    private $conn;
    private $serverDAO;
    private $MAX_LIMIT_OF_READINGS = 10;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
        $this->serverDAO = new ServerDAO();
    }

    public function createSystemStats(SystemStats $systemStats) {
        try {
            $response = array();

            if ($this->checkIfLimitIsExceeded($systemStats->serverIdFk)) {
                if (!$this->archiveOldestSystemStatsByServerId($systemStats->serverIdFk)) {
                    $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
                    return $response;
                }
            }

            if (Validator::checkArrayForEmptyInput((array)$systemStats)) {
                $response['error'] = Validator::checkArrayForEmptyInput((array)$systemStats);
                return $response;
            }

            $sql = "INSERT INTO system_stats(uptime, created_at, server_id) 
                VALUES(:uptime, :created_at, :server_id)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':uptime', $systemStats->uptime, PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $systemStats->createdAt, PDO::PARAM_INT);
            $stmt->bindParam(':server_id', $systemStats->serverIdFk, PDO::PARAM_INT);

            $stmt->execute();

            $response['message'] = "200 | OK - The system stats were successfully created.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function getSystemStats() {
        try {
            $response = array();

            $servers = $this->serverDAO->getServers()['servers'];

            foreach ($servers as $server) {
                $cpuReadings = array();

                $cpuReadings['server'] = $server;
                $cpuReadings['systemStats'] = $this->getSystemStatsByServerId($server->serverId)['systemStats'];

                array_push($response, $cpuReadings);
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }

    public function getSystemStatsByServerId($serverId) {
        try {
            $response['systemStats'] = array();

            $sql = "SELECT * FROM system_stats WHERE server_id = :server_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            foreach ($stmt as $row) {
                $systemStats = new SystemStats();

                $systemStats->setData($row['system_stat_id'],
                    $row['uptime'],
                    $row['created_at'],
                    $row['server_id']);

                array_push($response['systemStats'], $systemStats);
            }

            return $response;
        } catch (Exception $e) {
            echo $e->getMessage();
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }
    
    public function getArchivedSystemStatsByServerId($serverId) {
        try {
            $response['archivedSystemStats'] = array();

            $sql = "SELECT * FROM archived_system_stats WHERE server_id = :server_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            foreach ($stmt as $row) {
                $systemStats = new SystemStats();

                $systemStats->setData($row['archived_system_stat_id'],
                    $row['uptime'],
                    $row['created_at'],
                    $row['server_id']);

                array_push($response['archivedSystemStats'], $systemStats);
            }

            return $response;
        } catch (Exception $e) {
            echo $e->getMessage();
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        } 
    }

    public function deleteSystemStatsByServerId($serverId) {
        try {
            $response = array();

            $sql = "DELETE FROM system_stats WHERE server_id = :server_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            $response['message'] = "200 | OK - The system stats were successfully deleted.";
            return $response;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function deleteArchivedSystemStatsByServerId($serverId) {
        try {
            $response = array();

            $sql = "DELETE FROM archived_system_stats WHERE server_id = :server_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            $response['message'] = "200 | OK - The archived system stats were successfully deleted.";
            return $response;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function checkIfLimitIsExceeded($serverId) {
        try {
            $sql = "SELECT * FROM system_stats WHERE server_id = :server_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll();

            return sizeof($results) >= $this->MAX_LIMIT_OF_READINGS;
        } catch (Exception $e) {
            return false;
        }
    }

    private function archiveOldestSystemStatsByServerId($serverId) {
        try {
            $sql = "INSERT INTO archived_system_stats(uptime, created_at, server_id) SELECT uptime, created_at, server_id FROM system_stats WHERE server_id = :server_id ORDER BY created_at ASC LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            $sql = "DELETE FROM system_stats WHERE server_id = :server_id ORDER BY created_at ASC LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':server_id', $serverId, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

?>
