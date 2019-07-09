<?php

    require 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    class JWTHelper {
        // Der Secret-Key wird verwendet, um den JWT zu signieren. Dieser sollte nicht in die Hände der Benutzer kommen, da man dadurch die Signatur fälschen kann.
        private $secret = "PEo9zwRUd1H75WhiJI2HurrjthtesWW85t";
        private $expiration_time = 36000000;
        private $alg = 'HS256';

        public function __construct() {

        }

        // Erstellt einen JSON-Web-Token mit den Benutzerdaten.
        public function generateJWT(User $user) {
            $issuedAt = time();
            $exp = $issuedAt + $this->expiration_time;
            $payload = array(
                'user' => $user,
                'iat' => $issuedAt,
                'exp' => $exp
            );

            return JWT::encode($payload, $this->secret, $this->alg);
        }

        // Validiert die Signatur des JWT mit dem Secret Key, der hier gespeichert wurde.
        public function verifyJWT($jwt) {
            try {
                $decoded = JWT::decode($jwt, $this->secret, array('HS256'));
                return true;
            } catch(Exception $e) {
                return false;
            }
        }

        // Wenn die Signatur korrekt ist, wird der Inhalt des JWT zurückgegeben.
        public function decodeJWT($jwt) {
            try {
                return JWT::decode($jwt, $this->secret, array('HS256'));
            } catch(Exception $e) {
                return false;
            }
        }
    }
?>
