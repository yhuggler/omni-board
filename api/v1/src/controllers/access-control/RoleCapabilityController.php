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
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request['inputs'];
        
        $response = $this->roleCapabilityDAO->assignCapabilityToRole($inputs['capabilityId'], $inputs['roleId']);
        Response::json(200, $response);
    }
    
    public function getRolesWithCapabilities() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);
        
        $response = $this->roleCapabilityDAO->getRolesWithCapabilities();
        Response::json(200, $response);
    }
    
    public function removeCapabilityFromRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request['inputs'];
        
        $response = $this->roleCapabilityDAO->removeCapabilityFromRole($inputs['capabilityId'], $inputs['roleId']);
        Response::json(200, $response);
    }
}

?>
