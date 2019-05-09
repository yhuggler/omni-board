<?php

    class UserController {
        private $userDAO;
        private $middleware;

        public function __construct() {
            $this->userDAO = new UserDAO();
            $this->middleware = new Middleware();
        }

        public function createAuthenticationToken() {
            $response = $this->userDAO->createAuthenticationToken();
            Response::json(200, $response);
        }
    }
