<?php

abstract class Errors {
    const BAD_REQUEST = "400 | Bad Request - Please try again using valid data.";
    const INTERNAL_MYSQL_ERROR = "500 | Internal Server Error - During the Database Interaction, an error occured. Please contact the system administrator.";
    const INVALID_REQUEST = "Invalid Request";
}

?>
