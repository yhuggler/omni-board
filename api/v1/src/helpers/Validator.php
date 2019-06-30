<?php

class Validator {
    public static function validateUsername(string $username) {
        $response = array();

        if (empty($username)) array_push($response['errors'], "The username mustn't be empty.");
        if (preg_match('~[0-9]~', $username)) array_push($response['errors'], "The username musn't contain numbers.");

        return $response;
    }

    public static function validatePassword(string $password, string $repeatPassword) {
        $response = array();

        if (empty($password) || empty($repeatPassword)) array_push($response['errors'], "The password can't be empty");
        if ($password !== $repeatPassword) array_push($response['errors'], "The passwords don't match");
        if (strlen($password) < 8) array_push($response['errors'], "The password is too short.");
        if (!preg_match('~[0-9]~', $password)) array_push($response['errors'], "The password must contain numbers.");

        return $response;
    }

    public static function validateRole(int $role) {
        $response = array();

        if ($role > 2 || $role < 1) array_push($response['errors'], "The role must be between 1 and 2");

        return $response;
    }

    public static function checkArrayForEmptyInput($array) {
        foreach ($array as $key => $value) {
            if ($array[$key] == null)
                return $key . " can't be empty."; 
        }
    }

}

?>
