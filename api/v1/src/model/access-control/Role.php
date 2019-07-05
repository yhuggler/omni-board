<?php

class Role {
    public $roleId;
    public $roleTitle;
    public $roleDescription;

    public function __construct(int $roleId, string $roleTitle, string $roleDescription) {
        $this->roleId = $roleId;
        $this->roleTitle = $roleTitle;
        $this->roleDescription = $roleDescription;
    }
}

?>
