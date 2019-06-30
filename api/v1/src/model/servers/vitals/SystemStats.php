<?php

class SystemStats {
    public $systemStatId;
    public $uptime;
    public $createdAt;
    public $serverIdFk;

    public function __construct(int $systemStatId, int $uptime, int $createdAt, int $serverIdFk) {
        $this->systemStatId = $systemStatId;
        $this->uptime = $uptime;
        $this->createdAt = $createdAt;
        $this->serverIdFk = $serverIdFk;
    }
}

?>
