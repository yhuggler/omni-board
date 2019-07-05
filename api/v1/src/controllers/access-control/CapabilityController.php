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
        $this->middleware->checkPrivilegies($request['user'], 2);
       
        $inputs = $request["inputs"];

        $capability = new Capability(-1, $inputs['capability']);
        
        $response = $this->capabilityDAO->createCapability($capability);
        Response::json(200, $response);
    }
    
    public function getCapabilities() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);
       
        $inputs = $request["inputs"];
        
        $response = $this->capabilityDAO->getCapabilities();
        Response::json(200, $response);
    }
    
    public function updateCapability() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);
       
        $inputs = $request["inputs"];

        $capability = new Capability($inputs['capabilityId'], $inputs['capability']);
        
        $response = $this->capabilityDAO->updateCapability($capability);
        Response::json(200, $response);
    }
    
    public function deleteCapability() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);
       
        $inputs = $request["inputs"];

        $capabilityId = $inputs['capabilityId'];

        $response = $this->capabilityDAO->deleteCapability($capabilityId);
        Response::json(200, $response);
    }
}

?>
