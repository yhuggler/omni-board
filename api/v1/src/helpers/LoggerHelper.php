<?php

class LoggerHelper {

    public static function log($loggingLevel, $message) {
        $logDAO = new LogDAO();

        $logDAO->createLog($loggingLevel, $message);
    }
}

?>
