<?php

class HardwareInformation {
    public $hardwareInformationId; 
    public $serverIdFk; 
    public $manufacturer; 
    public $model; 
    public $version; 
    public $serial; 
    public $uuid; 
    public $sku; 
    public $biosVendor; 
    public $biosVersion; 
    public $biosReleaseDate; 
    public $biosRevision; 
    public $updatedAt;

    public function __construct() {

    }

    public function setData($hardwareInformationId, $serverIdFk, $manufacturer, $model, $version, $serial, $uuid, $sku, $biosVendor, $biosVersion, $biosReleaseDate, $biosRevision, $updatedAt) {
        $this->hardwareInformationId = $hardwareInformationId;
        $this->serverIdFk = $serverIdFk;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->version = $version;
        $this->serial = $serial;
        $this->uuid = $uuid;
        $this->sku = $sku;
        $this->biosVendor = $biosVendor;
        $this->biosVersion = $biosVersion;
        $this->biosReleaseDate = $biosReleaseDate;
        $this->biosRevision = $biosRevision;
        $this->updatedAt = $updatedAt;
    }
}

?>

