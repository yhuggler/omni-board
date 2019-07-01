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

        $createdAt = time(); 

        // First of all, I have to handle the recieval of the data.
        $mapper = new JsonMapper();

        $cpuInformationData = $inputs['cpuInformation'];
        $hardwareInformationData = $inputs['hardwareInformation'];
        $operatingSystemInformationData = $inputs['operatingSystemInformation'];
        
        // Mapping the json data to the custom php classes.
        $cpuInformation = $mapper->map($cpuInformationData, new CpuInformation());
        $hardwareInformation = $mapper->map($hardwareInformationData, new HardwareInformation());
        $operatingSystemInformation = $mapper->map($operatingSystemInformationData, new OperatingSystemInformation());

        $systemInformation = new SystemInformation($cpuInformation, $hardwareInformation, $operatingSystemInformation);

    }
}

