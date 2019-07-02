<?php

class OperatingSystemInformation {
    public $operatingSystemInformationId;
    public $serverIdFk;
    public $platform;
    public $distro;
    public $release;
    public $codename;
    public $kernel;
    public $arch;
    public $hostname;
    public $codepage;
    public $logofile;
    public $serial;
    public $build;
    public $servicePack;
    public $updatedAt;

    public function __construct() {

    }

    public function setData($operatingSystemInformationId, $serverIdFk, $platform, $distro, $release, $codename, $kernel, $arch, $hostname, $codepage, $logofile, $serial, $build, $servicePack, $updatedAt) {
        $this->operatingSystemInformationId = $operatingSystemInformationId;
        $this->serverIdFk = $serverIdFk;
        $this->platform = $platform;
        $this->distro = $distro;
        $this->release = $release;
        $this->codename = $codename;
        $this->kernel = $kernel;
        $this->arch = $arch;
        $this->hostname = $hostname;
        $this->codepage = $codepage;
        $this->logofile = $logofile;
        $this->serial = $serial;
        $this->build = $build;
        $this->servicePack = $servicePack;
        $this->updatedAt = $updatedAt;
    }
}

?>
