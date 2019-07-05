<?php

class RoleCapabilityDAO {
    private $conn;
    
    public function __construct() {
        $dbConn = new DBConnection();
        $this->conn = $dbConn->conn;
    }

    public function assignCapabilityToRole(int $capabilityId, int $roleId) {
        try {
            $response = array();

            $sql = "INSERT INTO roles_capabilities(role_id, capability_id) VALUES(:role_id, :capability_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->bindParam(':capability_id', $capabilityId, PDO::PARAM_INT);
            $stmt->execute();

            $response['message'] = "200 | OK - Successfully assigned the capability to the role.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
        
    public function getRolesWithCapabilities() {
        try {
            $response['roles'] = array();

            $sql = "SELECT * FROM roles_capabilities INNER JOIN roles ON roles.role_id = roles_capabilities.role_id";
            $stmt = $this->conn->prepare($sql);
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

    public function removeCapabilityFromRole($capabilityId, $roleId) {
        try {
            $response = array();

            $sql = "DELETE FROM roles_capabilities WHERE capability_id = :capability_id AND role_id = :role_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->bindParam(':capability_id', $capabilityId, PDO::PARAM_INT);
            $stmt->execute();

            $response['message'] = "200 | OK - Successfully removed the capability from the role.";
            return $response;
        } catch (Exception $e) {
            $response['error'] = Errors::INTERNAL_MYSQL_ERROR;
            return $response;
        }
    }
}

?>
