<?php

class RoleCapabilityController {
    private $roleCapabilityDAO;
    private $middleware;

    public function __construct() {
        $this->roleCapabilityDAO = new RoleCapabilityDAO();
        $this->middleware = new Middleware();
    }

    public function assignCapabilityToRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('ASSIGN_CAPABILITY_TO_ROLE', $request['user']);

        $inputs = $request['inputs'];
        
        $response = $this->roleCapabilityDAO->assignCapabilityToRole($inputs['capabilityId'], $inputs['roleId']);
        Response::json(200, $response);
    }
    
    public function getRolesWithCapabilities() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('GET_ROLES_WITH_CAPABILITIES', $request['user']);
        
        $response = $this->roleCapabilityDAO->getRolesWithCapabilities();
        Response::json(200, $response);
    }
    
    public function removeCapabilityFromRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('REMOVE_CAPABILITY_FROM_ROLE', $request['user']);

        $inputs = $request['inputs'];
        
        $response = $this->roleCapabilityDAO->removeCapabilityFromRole($inputs['capabilityId'], $inputs['roleId']);
        Response::json(200, $response);
    }
}

?>
