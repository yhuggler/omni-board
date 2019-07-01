<?php

class CpuInformation {
    public $cpuInformationId; 
    public $serverIdFk; 
    public $manufacturer; 
    public $brand; 
    public $speedMin; 
    public $speedMax; 
    public $cores; 
    public $physicalCores; 
    public $processors; 
    public $socket; 
    public $vendor; 
    public $family; 
    public $model; 
    public $stepping; 
    public $revision; 
    public $voltage; 
    public $updatedAt; 

    /*
    public function __construct($cpuInformationId, $serverIdFk, $manufacturer, $brand, $speedMin, $speedMax, $cores, $physicalCores, $processors, $socket, $vendor, $family, $model, $stepping, $revision, $voltage, $updatedAt) {
        $this->cpuInformationId = $cpuInformationId;
        $this->serverIdFk = $serverIdFk;
        $this->manufacturer = $manufacturer;
        $this->brand = $brand;
        $this->speedMin = $speedMin;
        $this->speedMax = $speedMax;
        $this->cores = $cores;
        $this->physicalCores = $physicalCores;
        $this->processors = $processors;
        $this->socket = $socket;
        $this->vendor = $vendor;
        $this->family = $family;
        $this->model = $model;
        $this->stepping = $stepping;
        $this->revision = $revision;
        $this->voltage = $voltage;
        $this->updatedAt = $updatedAt;
    }*/

    public function __construct() {

    }

    public function setData($cpuInformationId, $serverIdFk, $manufacturer, $brand, $speedMin, $speedMax, $cores, $physicalCores, $processors, $socket, $vendor, $family, $model, $stepping, $revision, $voltage, $updatedAt) {
        $this->cpuInformationId = $cpuInformationId;
        $this->serverIdFk = $serverIdFk;
        $this->manufacturer = $manufacturer;
        $this->brand = $brand;
        $this->speedMin = $speedMin;
        $this->speedMax = $speedMax;
        $this->cores = $cores;
        $this->physicalCores = $physicalCores;
        $this->processors = $processors;
        $this->socket = $socket;
        $this->vendor = $vendor;
        $this->family = $family;
        $this->model = $model;
        $this->stepping = $stepping;
        $this->revision = $revision;
        $this->voltage = $voltage;
        $this->updatedAt = $updatedAt;
    }
}

?>
