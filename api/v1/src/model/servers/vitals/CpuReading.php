<?php

class CpuReading {
    public $cpuReadingId;
    public $currentLoad;
    public $currentClockspeed;
    public $currentTemp;
    public $createdAt;
    public $serverIdFk;

    public function __construct() {

    }

    public function setData(int $cpuReadingId, float $currentLoad, float $currentClockspeed, float $currentTemp, int $createdAt, int $serverIdFk) {
        $this->cpuReadingId = $cpuReadingId;
        $this->currentLoad = $currentLoad;
        $this->currentClockspeed = $currentClockspeed;
        $this->currentTemp = $currentTemp;
        $this->createdAt = $createdAt;
        $this->serverIdFk = $serverIdFk;
    }
}

?>
