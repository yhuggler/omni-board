<?php

class RoleController {

    private $middleware;
    private $roleDAO;
    
    public function __construct() {
        $this->middleware = new Middleware(); 
        $this->roleDAO = new RoleDAO();
    }

    public function createRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('ADD_ROLE', $request['user']);
       
        $inputs = $request["inputs"];

        $role = new Role(-1, $inputs['roleTitle'], $inputs['roleDescription'], array());
        
        $response = $this->roleDAO->createRole($role);
        Response::json(200, $response);
    }
    
    public function getRoles() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('GET_ROLES', $request['user']);
        
        $response = $this->roleDAO->getRoles();
        Response::json(200, $response);
    }
    
    public function updateRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('UPDATE_ROLE', $request['user']);
       
        $inputs = $request["inputs"];

        $role = new Role($inputs['roleId'], $inputs['roleTitle'], $inputs['roleDescription'], array());
        
        $response = $this->roleDAO->updateRole($role);
        Response::json(200, $response);
    }
    
    public function deleteRole() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('DELETE_ROLE', $request['user']);
       
        $inputs = $request["inputs"];

        $roleId = $inputs['roleId'];

        $response = $this->roleDAO->deleteRole($roleId);
        Response::json(200, $response);
    }
}

?>

