<?php

class Vitals {
    public $cpuReading;
    public $gpuReading;
    public $systemStats;

    public function __construct(CpuReading $cpuReading, GpuReading $gpuReading, SystemStats $systemStats) {
        $this->cpuReading = $cpuReading;
        $this->gpuReading = $gpuReading;
        $this->systemStats = $systemStats;
    }
}

?>
