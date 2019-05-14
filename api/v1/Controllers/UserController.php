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

            $response= $this->userDAO->handleSignin($inputs['username'], $inputs['password']);
            Response::json(200, $response);
        }

        public function handleSignup() {

        }
    }
