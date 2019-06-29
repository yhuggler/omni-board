<?php

class SystemStats {
    public $systemStatId;
    public $uptime;
    public $serverIdFk;

    public function __construct(int $systemStatId, int $uptime, int $serverIdFk) {
        $this->systemStatId = $systemStatId;
        $this->uptime = $uptime;
        $this->serverIdFk = $serverIdFk;
    }
}

?>
