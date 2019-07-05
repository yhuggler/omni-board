<?php
class Middleware {

    private $jwtHelper;
    private $authKeyManager;
    private $roleCapabilityDAO;
    private $userRoleDAO;

    public function __construct() {
        $this->jwtHelper = new JWTHelper();
        $this->authKeyManager = new AuthKeyManager();
        $this->roleCapabilityDAO = new RoleCapabilityDAO();
        $this->userRoleDAO = new UserRoleDAO();
    }

    public function getRequest() {
        $request = array();    
        $request['inputs'] = (array) json_decode(file_get_contents("php://input")); 
        return $request;
    }

    public function checkAuth() {
        $request = array();    
        $token = $this->getBearerToken();

        if ($this->jwtHelper->verifyJWT($token)) {
            $request['inputs'] = (array) json_decode(file_get_contents("php://input")); 
            $request['user'] = $this->jwtHelper->decodeJWT($token)->user;
            return $request;
        }

        Response::json(403, array(
            "error" => "Insufficient privilegies"
        ));
    }
    
    public function hasCapability($capability, $user) {
        $rolesWithCapabilities = $this->userRoleDAO->getRolesWithCapabilitiesByUserId($user->id); 

        foreach ($rolesWithCapabilities['roles'] as $role) {
            $capabilities = $role->capabilities;

            foreach ($capabilities as $tempCapability) {
                if ($tempCapability->capability === $capability)
                    return true;
            }
        }
        
        Response::json(403, array(
            "error" => "Insufficient privilegies"
        ));
    }

    public function checkAuthKey() {
        $request = array();    
        $token = $this->getBearerToken();

        if ($this->authKeyManager->verifyAuthKey($token)) {
            $request['inputs'] = (array) json_decode(file_get_contents("php://input")); 
            $request['serverId'] = $this->authKeyManager->getServerIdByAuthKey($token);
            return $request;
        }

        Response::json(403, array(
            "error" => "Insufficient privilegies"
        ));
    }


    private function getAuthorizationHeader(){
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();

            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));

            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    private function getBearerToken() {
        $headers = $this->getAuthorizationHeader();

        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}
?>
