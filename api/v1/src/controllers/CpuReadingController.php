<?php

class CpuReadingController {
    private $cpuReadingDAO;
    private $middleware;

    public function __construct() {
        $this->cpuReadingDAO = new CpuReadingDAO();
        $this->middleware = new Middleware();
    }

    public function createCpuReading() {
        $request = $this->middleware->checkAuthKey();
        $inputs = $request["inputs"];

        $createdAt = time();        
        $serverId = $request['serverId'];

        $mapper = new JsonMapper();

        $cpuReadingData = $inputs['cpuReading'];
        
        $cpuReading = $mapper->map($cpuReadingData, new CpuReading());
        
        $cpuReading->cpuReadingId = -1;
        $cpuReading->createdAt = $createdAt;
        $cpuReading->serverIdFk = $serverId;
        
        $response = $this->cpuReadingDAO->createCpuReading($cpuReading);
        Response::json(200, $response);
    }

    public function getCpuReadings() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->cpuReadingDAO->getCpuReadings();
        Response::json(200, $response);
    }

    public function getCpuReadingsByServerId($id) {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->cpuReadingDAO->getCpuReadingsByServerId($id);
        Response::json(200, $response);
    }

    public function getArchivedCpuReadingsByServerId($id) {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $response = $this->cpuReadingDAO->getArchivedCpuReadingsByServerId($id);
        Response::json(200, $response);
    }

    public function deleteCpuReadingsByServerId() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $response = $this->cpuReadingDAO->deleteCpuReadingsByServerId($inputs['serverId']);
        Response::json(200, $response);
    }

    public function deleteArchivedCpuReadingsByServerId() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $response = $this->cpuReadingDAO->deleteArchivedCpuReadingsByServerId($inputs['serverId']);
        Response::json(200, $response);
    }
}

?>
