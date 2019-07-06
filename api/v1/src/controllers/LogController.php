<?php

class LogController {
    private $middleware;
    private $logDAO;

    public function __construct() {
        $this->middleware = new Middleware();
        $this->logDAO = new LogDAO();
    }

    public function getLogs() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('GET_LOGS', $request['user']);

        $response = $this->logDAO->getLogs();
        Response::json(200, $response);
    }
    
    public function deleteLogs() {
        $request = $this->middleware->checkAuth();
        $this->middleware->hasCapability('DELETE_LOGS', $request['user']);

        $response = $this->logDAO->deleteLogs();
        Response::json(200, $response);
    }
}

?>
