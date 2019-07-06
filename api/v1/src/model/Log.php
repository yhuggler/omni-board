<?php

class Log {
    public $logId;
    public $loggingLevel;
    public $message;
    public $client;
    public $ipAddress;
    public $requestMethod;
    public $requestURI;
    public $createdAt;

    public function __construct(int $logId, string $loggingLevel, string $message, string $client, string $ipAddress, string $requestMethod, string $requestURI, $createdAt) {
        $this->logId = $logId;
        $this->loggingLevel = $loggingLevel;
        $this->message = $message;
        $this->client = $client;
        $this->ipAddress = $ipAddress;
        $this->requestMethod = $requestMethod;
        $this->requestURI = $requestURI;
        $this->createdAt = $createdAt;
    }
}

?>
