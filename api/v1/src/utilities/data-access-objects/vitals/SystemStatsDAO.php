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

}

?>
