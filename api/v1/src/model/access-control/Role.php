<?php

class Role {
    public $roleId;
    public $roleTitle;
    public $roleDescription;
    public $capabilities;

    public function __construct(int $roleId, string $roleTitle, string $roleDescription, array $capabilities) {
        $this->roleId = $roleId;
        $this->roleTitle = $roleTitle;
        $this->roleDescription = $roleDescription;
        $this->capabilities = $capabilities;
    }
}

?>
