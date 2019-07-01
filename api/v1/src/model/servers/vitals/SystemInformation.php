<?php

class SystemInformation {
    public $cpuInformation;
    public $hardwareInformation;
    public $operatingSystemInformation;

    public function __construct($cpuInformation, $hardwareInformation, $operatingSystemInformation) {
        $this->cpuInformation = $cpuInformation;
        $this->hardwareInformation = $hardwareInformation;
        $this->operatingSystemInformation = $operatingSystemInformation;
    }
}

?>
