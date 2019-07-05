<?php

class Capability {
    public $capabilityId;
    public $capability;

    public function __construct(int $capabilityId, string $capability) {
        $this->capabilityId = $capabilityId;
        $this->capability = $capability;
    }
}

?>
