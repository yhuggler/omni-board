<?php

class UserController {
    private $userDAO;
    private $middleware;

    public function __construct() {
        $this->userDAO = new UserDAO();
        $this->middleware = new Middleware();
    }

    public function initialSetup() {
        $response = $this->userDAO->initialSetup();
        Response::json(200, $response);
    }

    public function handleSignin() {
        $request = $this->middleware->getRequest();
        $inputs = $request["inputs"];

        $username = isset($inputs['username']) ? $inputs['username'] : "";
        $password = isset($inputs['password']) ? $inputs['password'] : "";

        $response= $this->userDAO->handleSignin($username, $password);
        Response::json(200, $response);
    }

    public function createUser() {
        $request = $this->middleware->checkAuth();
        $this->middleware->checkPrivilegies($request['user'], 2);

        $inputs = $request["inputs"];

        $user = array();

        $user['username'] = isset($inputs['username']) ? $inputs['username'] : "";
        $user['password'] = isset($inputs['password']) ? $inputs['password'] : "";
        $user['repeatPassword'] = isset($inputs['repeatPassword']) ? $inputs['repeatPassword'] : "";
        $user['role'] = isset($inputs['role']) ?  $inputs['role'] : -1;

        $response = $this->userDAO->createUser($user);
        Response::json(200, $response);
    }
}
