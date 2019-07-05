<?php

class RoleDAO {

    private $conn;

    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function createRole(Role $role) {
        try {
            $response = array();

            if (Validator::checkArrayForEmptyInput((array)$role)) {
                $response['error'] = Validator::checkArrayForEmptyInput((array)$role);
                return $response;
            }

            $sql = "INSERT INTO roles(role_title, role_description) VALUES(:role_title, :role_description)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':role_title', $role->roleTitle, PDO::PARAM_STR);
            $stmt->bindParam(':role_description', $role->roleDescription, PDO::PARAM_STR);
            $stmt->execute();

            $response['message'] = "200 | OK - The role was created successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
    
    public function getRoles() {
        try {
            $response['roles'] = array();

            $sql = "SELECT * FROM roles ORDER BY role_id ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            foreach ($stmt as $row) {
                $role = new Role($row['role_id'], $row['role_title'], $row['role_description']);
                array_push($response['roles'], $role);
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }   
    }
    
    public function updateRole(Role $role) {
        try {
            $response = array();

            if (Validator::checkArrayForEmptyInput((array)$role)) {
                $response['error'] = Validator::checkArrayForEmptyInput((array)$role);
                return $response;
            }

            $sql = "UPDATE roles SET role_title = :role_title, role_description = :role_description WHERE role_id = :role_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':role_id', $role->roleId, PDO::PARAM_INT);
            $stmt->bindParam(':role_title', $role->roleTitle, PDO::PARAM_STR);
            $stmt->bindParam(':role_description', $role->roleDescription, PDO::PARAM_STR);
            $stmt->execute();

            $response['message'] = "200 | OK - The role was updated successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
    
    public function deleteRole(int $roleId) {
        try {
            $response = array();

            $sql = "DELETE FROM roles WHERE role_id = :role_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->execute();

            $response['message'] = "200 | OK - The role was deleted successfully.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
}

?>
