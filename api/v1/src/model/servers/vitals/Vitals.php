<?php

class Vitals {
    public $cpuReading;
    public $systemStats;

    public function __construct(CpuReading $cpuReading, SystemStats $systemStats) {
        $this->cpuReading = $cpuReading;
        $this->systemStats = $systemStats;
    }
}

?>
