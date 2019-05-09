<?php

class UserDAO {

	private $conn;

	public function __construct() {
	    $dbConn = new DBConnection();
		$this->conn = $dbConn->conn;
	}

    public function initialSetup(): array {
        try {
            $response = array();

            if ($this->checkIfAuthenticationTokenExists()) {
                $response['error'] = "There has already been created an initial account.";
                return $response;
            } 
            
            $token = bin2hex(openssl_random_pseudo_bytes(128));
                
            $sql = "INSERT INTO authentication_tokens(token) VALUES(:token)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            $response['token'] = $token;
           
            $username = "admin";
            $password = bin2hex(openssl_random_pseudo_bytes(6));

            $sql = "INSERT INTO users(username, password) VALUES(:username, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $response['user'] = array(
                "username" => "admin",
                "password" => $password
            );

            return $response;
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return $response;
        } 
    }

    public function verifyAuthenticationToken(string $token): bool {
        try {
            $sql = "SELECT * FROM authentication_tokens WHERE token = :token"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            $authenticationTokensResults = $stmt->fetchAll();

            return !empty($authenticationTokensResults);
        } catch (Exception $e) {
            return false;
        } 
    }

    public function checkIfAuthenticationTokenExists(): bool {
        try {
            $sql = "SELECT * FROM authentication_tokens"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $authenticationTokensResults = $stmt->fetchAll();

            return !empty($authenticationTokensResults);
        } catch (Exception $e) {
            return false;
        } 
    }

    public function handleSignin() {

    }
}
