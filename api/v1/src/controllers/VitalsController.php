<?php

class VitalsController {
    private $vitalsDAO;
    private $middleware;

    public function __construct() {
        $this->vitalsDAO = new VitalsDAO();
        $this->middleware = new Middleware();
    }

    public function createVitalsReading() {
        $request = $this->middleware->checkAuthKey();
        $inputs = $request["inputs"];

        $createdAt = time();        
        $serverId = $request['serverId'];

        $mapper = new JsonMapper();

        $cpuReadingData = $inputs['cpuReading'];
        $systemStatsData = $inputs['systemStats'];
        
        $cpuReading = $mapper->map($cpuReadingData, new CpuReading());
        $systemStats = $mapper->map($systemStatsData, new SystemStats());

        $cpuReading->cpuReadingId = -1;
        $cpuReading->createdAt = $createdAt;
        $cpuReading->serverIdFk = $serverId;
        
        $systemStats->systemStatId = -1;
        $systemStats->createdAt = $createdAt;
        $systemStats->serverIdFk = $serverId;

        $vitals = new Vitals($cpuReading, $systemStats);

        $response = $this->vitalsDAO->createVitalsReading($vitals);
        Response::json(200, $response);
    }

    public function getVitalReadings() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);
    
        $response = $this->vitalsDAO->getVitalReadings();
        Response::json(200, $response);
    }

    public function deleteVitalReadingsByServerId() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $response = $this->vitalsDAO->deleteVitalReadingsByServerId($inputs['serverId']);
        Response::json(200, $response);
    }
}
