<?php
    class Server {

        public $serverId;
        public $friendlyName;
        public $description;
        public $authKey;
        
        public function __construct($serverId, $friendlyName, $description, $authKey) {
            $this->serverId = $serverId;
            $this->friendlyName = $friendlyName;
            $this->description = $description;
            $this->authKey = $authKey;
        }
    }
?>
