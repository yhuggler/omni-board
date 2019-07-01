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

        // First of all, I have to handle the recieval of the data.
        $mapper = new JsonMapper();

        $cpuReadingData = $inputs['cpuReading'];
        $systemStatsData = $inputs['systemStats'];
        
        // Mapping the json data to the custom php classes.
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

    public function createSystemInformation() {

    }
}
