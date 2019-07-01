<?php

class SystemInformationController {
    private $systemInformationDAO;
    private $middleware;

    public function __construct() {
        $this->systemInformationDAO = new SystemInformationDAO();
        $this->middleware = new Middleware();
    }
    
    public function createSystemInformationEntry() {
        $request = $this->middleware->checkAuthKey();
        $inputs = $request["inputs"];

        $updatedAt = time();
        $serverId = $request['serverId'];

        // First of all, I have to handle the recieval of the data.
        $mapper = new JsonMapper();

        $cpuInformationData = $inputs['cpuInformation'];
        $hardwareInformationData = $inputs['hardwareInformation'];
        $operatingSystemInformationData = $inputs['operatingSystemInformation'];
        
        // Mapping the json data to the custom php classes.
        $cpuInformation = $mapper->map($cpuInformationData, new CpuInformation());
        $hardwareInformation = $mapper->map($hardwareInformationData, new HardwareInformation());
        $operatingSystemInformation = $mapper->map($operatingSystemInformationData, new OperatingSystemInformation());

        $cpuInformation->cpuInformationId = -1;
        $cpuInformation->updatedAt = $updatedAt;
        $cpuInformation->serverIdFk = $serverId;
        
        $hardwareInformation->hardwareInformationId = -1;
        $hardwareInformation->updatedAt = $updatedAt;
        $hardwareInformation->serverIdFk = $serverId;
        
        $operatingSystemInformation->operatingSystemInformationId = -1;
        $operatingSystemInformation->updatedAt = $updatedAt;
        $operatingSystemInformation->serverIdFk = $serverId;

        $systemInformation = new SystemInformation($cpuInformation, $hardwareInformation, $operatingSystemInformation);

        $response = $this->systemInformationDAO->createSystemInformationEntry($systemInformation);
        Response::json(200, $response);
    }
}

