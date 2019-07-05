<?php

class UserRoleDAO {
    private $conn;
    
    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function assignUserToRole(int $userId, int $roleId) {
        try {
            $response = array();

            $sql = "INSERT INTO user_roles(user_id, role_id) VALUES(:user_id, :role_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->execute();

            $response['message'] = "200 | OK - Successfully assigned the user to the role.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function getRolesWithCapabilitiesByUserId(int $userId) {
        try {
            $response['roles'] = array();

            $sql = "SELECT * FROM user_roles INNER JOIN roles ON user_roles.role_id = roles.role_id WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();


            $rolesResults = $stmt->fetchAll();

            foreach ($rolesResults as $roleResult) {
                $roleId = $roleResult['role_id'];
                $roleTitle = $roleResult['role_title'];
                $roleDescription = $roleResult['role_description'];

                $capabilities = array();

                $sql = "SELECT * FROM roles_capabilities INNER JOIN capabilities ON roles_capabilities.capability_id = capabilities.capability_id WHERE role_id = :role_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
                $stmt->execute();

                $capabilitiesResults = $stmt->fetchAll();

                foreach ($capabilitiesResults as $capabilityResult) {
                    $capability = new Capability($capabilityResult['capability_id'], $capabilityResult['capability']);
                    array_push($capabilities, $capability);
                }

                $role = new Role($roleId, $roleTitle, $roleDescription, $capabilities);
                array_push($response['roles'], $role);
            }

            return $response;
        } catch (Exception $e) {
            echo $e->getMessage();
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }

    public function removeUserFromRole($userId, $roleId) {
        try {
            $response = array();

            $sql = "DELETE FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->execute();

            $response['message'] = "200 | OK - Successfully removed the user from the role.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
}

?>

