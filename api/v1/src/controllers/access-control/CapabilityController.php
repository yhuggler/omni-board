<?php

class CapabilityController {

    private $middleware;
    private $capabilityDAO;
    
    public function __construct() {
        $this->middleware = new Middleware(); 
        $this->capabilityDAO = new CapabilityDAO();
    }

    public function createCapability() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('ADD_CAPABILITY', $request['user']);
       
        $inputs = $request["inputs"];

        $capability = new Capability(-1, $inputs['capability']);
        
        $response = $this->capabilityDAO->createCapability($capability);
        Response::json(200, $response);
    }
    
    public function getCapabilities() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('GET_CAPABILITIES', $request['user']);
       
        $inputs = $request["inputs"];
        
        $response = $this->capabilityDAO->getCapabilities();
        Response::json(200, $response);
    }
    
    public function updateCapability() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('UPDATE_CAPABILITY', $request['user']);
       
        $inputs = $request["inputs"];

        $capability = new Capability($inputs['capabilityId'], $inputs['capability']);
        
        $response = $this->capabilityDAO->updateCapability($capability);
        Response::json(200, $response);
    }
    
    public function deleteCapability($id) {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('DELETE_CAPABILITY', $request['user']);
       
        $response = $this->capabilityDAO->deleteCapability($id);
        Response::json(200, $response);
    }
}

?>
