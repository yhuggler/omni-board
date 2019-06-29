<?php

class SystemInformation {
    public $systemInformationId;
    public $hostname;
    public $vendor;
    public $ipAddress;
    public $macAddress;
    public $serverIdFk;

    public function __construct(int $systemStatId, string $hostname, string $vendor, string $ipAddress, string $macAddress, int $serverIdFk) {
        $this->systemInformationId = $systemInformationId;
        $this->hostname = $hostname;
        $this->vendor = $vendor;
        $this->ipAddress = $ipAddress;
        $this->macAddress = $macAddress;
        $this->serverIdFk = $serverIdFk;
    }
}

?>

