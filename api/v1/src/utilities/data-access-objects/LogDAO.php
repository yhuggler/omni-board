<?php

class LogDAO {
    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createLog($loggingLevel, $message) {
        try {
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $requestURI = $_SERVER['REQUEST_URI'];
            $client = $_SERVER['HTTP_USER_AGENT'];
            $ipAddress = $_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO logs(logging_level, message, client, ip_address, request_method, request_uri) 
                VALUES(:logging_level, :message, :client, :ip_address, :request_method, :request_uri)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':logging_level', $loggingLevel, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':client', $client, PDO::PARAM_STR);
            $stmt->bindParam(':ip_address', $ipAddress, PDO::PARAM_STR);
            $stmt->bindParam(':request_method', $requestMethod, PDO::PARAM_STR);
            $stmt->bindParam(':request_uri', $requestURI, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getLogs() {
        try {
            $response['logs'] = array();

            $sql = "SELECT * FROM logs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            foreach ($stmt as $row) {
                $log = new Log(
                    $row['log_id'],
                    $row['logging_level'],
                    $row['message'],
                    $row['client'],
                    $row['ip_address'],
                    $row['request_method'],
                    $row['request_uri'],
                    $row['created_at']
                );

                array_push($response['logs'], $log);
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function deleteLogs() {
        try {
            $response = array();

            $sql = "DELETE FROM logs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $response['message'] = "200 | OK - The log was cleared successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
}

?>
