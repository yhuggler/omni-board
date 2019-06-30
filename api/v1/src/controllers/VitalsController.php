<?php

class VitalsController {
    private $vitalsDAO;
    private $middleware;

    public function __construct() {
        $this->vitalsDAO = new VitalsDAO();
        $this->middleware = new Middleware();
    }

    public function createVitalsReading() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $createdAt = time();        

        // Cpu-Reading
        $cpuData = $inputs['cpuReading'];

        $cpuReading = new CpuReading(-1, 
            $cpuData->currentLoad ?? 0,
            $cpuData->currentClockspeed ?? 0,
            $cpuData->maxClockspeed ?? 0,
            $cpuData->minClockspeed ?? 0,
            $cpuData->currentTemp ?? 0,
            $cpuData->tempLimitTdp ?? 0, 
            $createdAt,
            $cpuData->serverIdFk ?? 0
        );

        // Gpu-Reading
        $gpuData = $inputs['gpuReading'];

        $gpuReading = new GpuReading(-1, 
            $gpuData->currentLoad ?? 0,
            $gpuData->currentClockspeed ?? 0,
            $gpuData->maxClockspeed ?? 0,
            $gpuData->minClockspeed ?? 0,
            $gpuData->currentTemp ?? 0,
            $gpuData->tempLimitTdp ?? 0,
            $gpuData->memoryClockspeed ?? 0, 
            $createdAt,
            $gpuData->serverIdFk ?? 0
        );

        // System Stats
        $systemStatsData = $inputs['systemStats'];

        $systemStats = new SystemStats(-1,
            $systemStatsData->uptime ?? 0,
            $createdAt,
            $systemStatsData->serverIdFk ?? 0
        );

        $vitals = new Vitals($cpuReading, $gpuReading, $systemStats);

        $response = $this->vitalsDAO->createVitalsReading($vitals);
        Response::json(200, $response);
    }
}
