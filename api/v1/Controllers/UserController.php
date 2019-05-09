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
    }
