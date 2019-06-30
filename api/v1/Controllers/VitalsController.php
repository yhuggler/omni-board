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

        // Cpu-Reading
        $cpuData = $inputs['cpuReading'];

        $cpuReading = new CpuReading(-1, 
            $cpuData->currentLoad,
            $cpuData->currentClockspeed,
            $cpuData->maxClockspeed,
            $cpuData->minClockspeed,
            $cpuData->currentTemp,
            $cpuData->tempLimitTdp,
            $cpuData->createdAt,
            $cpuData->serverIdFk);

        // Gpu-Reading
        $gpuData = $inputs['gpuReading'];

        $gpuReading = new GpuReading(-1, 
            $gpuData->currentLoad,
            $gpuData->currentClockspeed,
            $gpuData->maxClockspeed,
            $gpuData->minClockspeed,
            $gpuData->currentTemp,
            $gpuData->tempLimitTdp,
            $gpuData->memoryClockspeed,
            $gpuData->createdAt,
            $gpuData->serverIdFk);

        var_dump($gpuReading);
    }
}
