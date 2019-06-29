<?php

class CpuReading {
    public $cpuReadingId;
    public $currentLoad;
    public $currentClockspeed;
    public $maxClockspeed;
    public $minClockspeed;
    public $currentTemp;
    public $tempLimitTdp;
    public $createdAt;
    public $serverIdFk;

    public function __construct(int $cpuReadingId, float $currentLoad, float $currentClockspeed, float $maxClockspeed, float $minClockspeed, float $currentTemp, float $tempLimitTdp, int $createdAt, int $serverIdFk) {
        $this->cpuReadingId = $cpuReadingId;
        $this->currentLoad = $currentLoad;
        $this->currentClockspeed = $currentClockspeed;
        $this->maxClockspeed = $maxClockspeed;
        $this->minClockspeed = $minClockspeed;
        $this->currentTemp = $currentTemp;
        $this->tempLimitTdp = $tempLimitTdp;
        $this->createdAt = $createdAt;
        $this->serverIdFk = $serverIdFk;
    }
}

?>
