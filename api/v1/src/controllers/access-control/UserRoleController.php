<?php

class UserRoleController {
    private $userRoleDAO;
    private $middleware;

    public function __construct() {
        $this->userRoleDAO = new UserRoleDAO();
        $this->middleware = new Middleware();
    }

    public function assignUserToRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('ASSIGN_USER_TO_ROLE', $request['user']);

        $inputs = $request['inputs'];
        
        $response = $this->userRoleDAO->assignUserToRole($inputs['userId'], $inputs['roleId']);
        Response::json(200, $response);
    }
    
    public function getRolesWithCapabilitiesByUserId($id) {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('GET_ROLES_WITH_CAPABILITIES_BY_USER_ID', $request['user']);
        
        $response = $this->userRoleDAO->getRolesWithCapabilitiesByUserId($id);
        Response::json(200, $response);
    }

    public function getRolesWithCapabilitiesByUsernameFuzzy($username) {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('GET_ROLES_WITH_CAPABILITIES_BY_USER_ID', $request['user']);

        $response = $this->userRoleDAO->getRolesWithCapabilitiesByUsernameFuzzy($username);
        Response::json(200, $response);
    }
    
    public function removeUserFromRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('REMOVE_USER_FROM_ROLE', $request['user']);

        $inputs = $request['inputs'];
        
        $response = $this->userRoleDAO->removeUserFromRole($inputs['userId'], $inputs['roleId']);
        Response::json(200, $response);
    }
}

?>

