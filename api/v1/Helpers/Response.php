<?php

	class Response {

            public static function json($status, $response) {
                http_response_code($status); 

                echo json_encode($response); 
                die();
            }

			public static function invalidJWT() {
				$response = array();

				http_response_code(403);

				$response['message'] = "Your session expired. Please sign in again.";

				echo json_encode($response);
				die();
			}

			public static function insufficientPrivileges() {
				$response = array();

				http_response_code(403);

				$response['message'] = "You're not allowed to access this method.";

				echo json_encode($response);
				die();
			}

			public static function sendGeneralErrorResponse() {
				$response = array();

				http_response_code(500);

				$response['message'] = "Internal Server Error";

				echo json_encode($response);
				die();
			}
	}
		
?>
