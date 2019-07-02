<?php

class SystemStatsDAO {
    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createSystemStats(SystemStats $systemStats) {
        try {
            if (Validator::checkArrayForEmptyInput((array)$systemStats)) {
                return false;
            }

            $sql = "INSERT INTO system_stats(uptime, created_at, server_id) 
                VALUES(:uptime, :created_at, :server_id)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':uptime', $systemStats->uptime, PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $systemStats->createdAt, PDO::PARAM_INT);
            $stmt->bindParam(':server_id', $systemStats->serverIdFk, PDO::PARAM_INT);

            $stmt->execute();
            return true;

        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function getSystemStatsByServerId($serverId) {
        try {
            $response = array();

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

                array_push($response, $systemStats);
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
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

?>
