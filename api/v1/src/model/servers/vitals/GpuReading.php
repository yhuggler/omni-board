<?php

class GpuReading {
    public $gpuReadingId;
    public $currentLoad;
    public $currentClockspeed;
    public $maxClockspeed;
    public $minClockspeed;
    public $currentTemp;
    public $memoryClockspeed;
    public $createdAt;
    public $serverIdFk;

    public function __construct(int $gpuReadingId, float $currentLoad, float $currentClockspeed, float $maxClockspeed, float $minClockspeed, float $currentTemp, float $memoryClockspeed, int $createdAt, int $serverIdFk) {
        $this->gpuReadingId = $gpuReadingId;
        $this->currentLoad = $currentLoad;
        $this->currentClockspeed = $currentClockspeed;
        $this->maxClockspeed = $maxClockspeed;
        $this->minClockspeed = $minClockspeed;
        $this->currentTemp = $currentTemp;
        $this->memoryClockspeed = $memoryClockspeed;
        $this->createdAt = $createdAt;
        $this->serverIdFk = $serverIdFk;
    }
}

?>

