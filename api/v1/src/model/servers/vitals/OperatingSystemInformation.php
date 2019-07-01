<?php

class OperatingSystemInformation {
    public $operatingSystemInformationId;
    public $serverIdFk;
    public $platform;
    public $distro;
    public $osRelease;
    public $codename;
    public $kernel;
    public $arch;
    public $hostname;
    public $codepage;
    public $logofile;
    public $serial;
    public $build;
    public $servicePack;
    public $uuid;
    public $defaultShell;
    public $updatedAt;

    /*
    public function __construct($operatingSystemInformationId, $serverIdFk, $platform, $distro, $osRelease, $codename, $kernel, $arch, $hostname, $codepage, $logofile, $serial, $build, $servicePack, $uuid, $defaultShell, $updatedAt) {
        $this->operatingSystemInformationId = $operatingSystemInformationId;
        $this->serverIdFk = $serverIdFk;
        $this->platform = $platform;
        $this->distro = $distro;
        $this->osRelease = $osRelease;
        $this->codename = $codename;
        $this->kernel = $kernel;
        $this->arch = $arch;
        $this->hostname = $hostname;
        $this->codepage = $codepage;
        $this->logofile = $logofile;
        $this->serial = $serial;
        $this->uuid = $uuid;
        $this->defaultShell = $defaultShell;
        $this->updatedAt = $updatedAt;
    }
     */

    public function __construct() {

    }

    public function setData($operatingSystemInformationId, $serverIdFk, $platform, $distro, $osRelease, $codename, $kernel, $arch, $hostname, $codepage, $logofile, $serial, $build, $servicePack, $uuid, $defaultShell, $updatedAt) {
        $this->operatingSystemInformationId = $operatingSystemInformationId;
        $this->serverIdFk = $serverIdFk;
        $this->platform = $platform;
        $this->distro = $distro;
        $this->osRelease = $osRelease;
        $this->codename = $codename;
        $this->kernel = $kernel;
        $this->arch = $arch;
        $this->hostname = $hostname;
        $this->codepage = $codepage;
        $this->logofile = $logofile;
        $this->serial = $serial;
        $this->uuid = $uuid;
        $this->defaultShell = $defaultShell;
        $this->updatedAt = $updatedAt;
    }
}

?>
