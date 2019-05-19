<?php

class Validator {
    public static function validateUsername(string $username) {
        $response = array();
        $response['errors'] = array();

        if (empty($userrname)) array_push($response['errors'], "The username mustn't be empty.");
        if (preg_match('~[0-9]~', $username)) array_push($response['errors'], "The username musn't contain numbers.");

        return $response;
    }

    public static function validatePassword(string $password, string $repeatPassword) {
        $response = array();
        $response['errors'] = array();

        if ($password !== $repeatPassword) array_push($response['errors'], "The passwords don't match");
        if (strlen($password) < 8) array_push($response['errors'], "The password is too short.");
        if (!preg_match('~[0-9]~', $password)) array_push($response['errors'], "The password must contain numbers.");

        return $response;
    }
}

?>
