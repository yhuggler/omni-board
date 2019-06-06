<?php

class ServerController {
    private $serverDAO;
    private $middleware;

    public function __construct() {
        $this->serverDAO = new ServerDAO();
        $this->middleware = new Middleware();
    }

    public function createServer() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $friendlyName = isset($inputs['friendlyName']) ? $inputs['friendlyName'] : ""; 
        $description = isset($inputs['description']) ? $inputs['description'] : ""; 

        $server = new Server(-1, $friendlyName, $description, "");

        $response = $this->serverDAO->createServer($server);
        Response::json(200, $response);
    }
    
    public function getServers() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->serverDAO->getServers($server);
        Response::json(200, $response);
    }
    
    public function getServerById($id) {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->serverDAO->getServerById($id);
        Response::json(200, $response);
    }
    
    public function updateServer() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $serverId = isset($inputs['serverId']) ? $inputs['serverId'] : ""; 
        $friendlyName = isset($inputs['friendlyName']) ? $inputs['friendlyName'] : ""; 
        $description = isset($inputs['description']) ? $inputs['description'] : ""; 

        $server = new Server($serverId, $friendlyName, $description, "");

        $response = $this->serverDAO->updateServer($server);
        Response::json(200, $response);
    }
    
    public function deleteServer() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $serverId = isset($inputs['serverId']) ? $inputs['serverId'] : ""; 
        $authKeyId = isset($inputs['authKeyId']) ? $inputs['authKeyId'] : ""; 

        $response = $this->serverDAO->deleteServer($serverId, $authKeyId);
        Response::json(200, $response);
    }
}

