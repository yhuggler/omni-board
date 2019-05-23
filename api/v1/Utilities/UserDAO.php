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

            if ($this->checkIfInitialUserExists()) {
                $response['error'] = "There has already been created an initial account.";
                return $response;
            } 
            
            $username = "admin";

            $password = bin2hex(openssl_random_pseudo_bytes(6));
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users(username, password) VALUES(:username, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
            $stmt->execute();

            $response['newUser'] = array(
                "username" => $username,
                "password" => $password
            );

            return $response;
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return $response;
        } 
    }

    public function checkIfInitialUserExists(): bool {
        try {
            $sql = "SELECT * FROM users"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $usersResults = $stmt->fetchAll();

            return !empty($usersResults);
        } catch (Exception $e) {
            return false;
        } 
    }

    public function handleSignin(string $username, string $password): array {
        try {
            $response = array();

            if ($username === "" || $password === "") {
                $response['error'] = "Please fill in all the fields.";
            }

            $username = strtolower($username);

            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $userResult = $stmt->fetch();

            if (!empty($userResult)) {
                $passwordHash = $userResult['password'];
                
                if (password_verify($password, $passwordHash)) {
                    $response['user'] = new User($userResult['id'], $userResult['username']);
                    $response['message'] = "You successfully signed in.";
                } else {
                    $response['error'] = "Auth failed. Please try again using diifferent credentials.";
                }
                
                return $response;
            } else {
                $response['error'] = "Auth failed. Please try again using diifferent credentials.";
                return $response;
            }
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return $response;
        } 
    }

    public function createUser($user) {
        try {
            $response = array();
                
            if (isset(Validator::validateUsername($user['username'])['errors']))
                return Validator::validateUsername($user['username'])['errors'];

            if (isset(Validator::validatePassword($user['password'], $user['repeatPassword'])['errors']))
                return Validator::validatePassword($user['password'], $user['repeatPassword'])['errors'];

                

                        
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return $response;
        }
    }
}
