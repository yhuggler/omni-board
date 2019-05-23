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
            $this->middleware->checkPrivilegies($request['user'], 3);


        }
    }
