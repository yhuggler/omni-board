<?php

class VitalsController {
    private $vitalsDAO;
    private $middleware;

    public function __construct() {
        $this->vitalsDAO = new VitalsDAO();
        $this->middleware = new Middleware();
    }

    public function createVitalsReading() {
        $request = $this->middleware->getRequest();

        $inputs = $request["inputs"];

        $createdAt = time();        

        // First of all, I have to handle the recieval of the data.

        $mapper = new JsonMapper();

        $cpuInformationData = $inputs['cpuInformation'];
        $hardwareInformationData = $inputs['hardwareInformation'];
        $operatingSystemInformationData = $inputs['operatingSystemInformation'];
        $cpuReadingData = $inputs['cpuReading'];
        $systemStatsData = $inputs['systemStats'];

        
        // Mapping the json data to the custom php classes.
        $cpuInformation = $mapper->map($cpuInformationData, new CpuInformation());
        $hardwareInformation = $mapper->map($hardwareInformationData, new HardwareInformation());
        $operatingSystemInformation = $mapper->map($operatingSystemInformationData, new OperatingSystemInformation());
        $cpuReading = $mapper->map($cpuReadingData, new CpuReading());
        $systemStats = $mapper->map($systemStatsData, new SystemStats());

        var_dump($systemStats);


        // $response = $this->vitalsDAO->createVitalsReading($vitals);
        // Response::json(200, $response);
    }

    public function createSystemInformation() {

    }
}
