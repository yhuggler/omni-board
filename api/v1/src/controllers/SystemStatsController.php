<?php

class SystemStatsController {
    private $systemStatsDAO;
    private $middleware;

    public function __construct() {
        $this->systemStatsDAO = new SystemStatsDAO();
        $this->middleware = new Middleware();
    }

    public function createSystemStats() {
        $request = $this->middleware->checkAuthKey();
        $inputs = $request["inputs"];

        $createdAt = time();        
        $serverId = $request['serverId'];

        $mapper = new JsonMapper();

        $systemStatsData = $inputs['systemStats'];
        
        $systemStats = $mapper->map($systemStatsData, new SystemStats());
        
        $systemStats->systemStatId = -1;
        $systemStats->createdAt = $createdAt;
        $systemStats->serverIdFk = $serverId;
        
        $response = $this->systemStatsDAO->createSystemStats($systemStats);
        Response::json(200, $response);
    }

    public function getSystemStats() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->systemStatsDAO->getSystemStats();
        Response::json(200, $response);
    }

    public function getSystemStatsByServerId($id) {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->systemStatsDAO->getSystemStatsByServerId($id);
        Response::json(200, $response);
    }

    public function getArchivedSystemStatsByServerId($id) {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->systemStatsDAO->getArchivedSystemStatsByServerId($id);
        Response::json(200, $response);
    }

    public function deleteSystemStatsByServerId() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $response = $this->systemStatsDAO->deleteSystemStatsByServerId($inputs['serverId']);
        Response::json(200, $response);
    }

    public function deleteArchivedSystemStatsByServerId() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $response = $this->systemStatsDAO->deleteArchivedSystemStatsByServerId($inputs['serverId']);
        Response::json(200, $response);
    }
}

?>

