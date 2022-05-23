<?php
session_start();
    class user {
        public $email;
        public $pswd;
        public $remember;
        public $captcha;

        function setUser() {
            $this->email = $_POST["email"];
            $this->pswd = $_POST["pswd"];
            $this->remember = $_POST["remember"];
            $this->captcha = $_POST['g-recaptcha-response'];
        }
        function formIsCorrect() {
            $secret_key = '6LfDXBEgAAAAACgjnrnUnZe309XItSb76Sc-9MUc';
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
            . $secret_key . '&response=' . $this->captcha;
            $response = file_get_contents($url);
            $response = json_decode($response);
            if ($response->success == true) {
                echo '<script>alert("Google reCAPTACHA verified")</script>';
            } else {
                saveUser();
                echo '<script>alert("Error in Google reCAPTACHA"); window.location = "http://localhost:3000/index.html";</script>';
                die();
            }
          
        }
        function saveUser() {
            $cookie_email_name = "email";
            $cookie_pswd_name = "pswd";
            $cookie_remember_name = "remember";
            
            if($this->remember) {
                $cookie_email_value = $this->email;
                $cookie_pswd_value = $this->pswd;
                $cookie_remember_value = $this->remember;
                setcookie($cookie_email_name, $cookie_email_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie($cookie_pswd_name, $cookie_pswd_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie($cookie_remember_name, cookie_remember_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            } else {
                unset($_COOKIE[$cookie_email_name]);
                unset($_COOKIE[$cookie_pswd_name]);
                setcookie($cookie_email_name,null,-1,"/");
                setcookie($cookie_pswd_name,null,-1,"/");
            }
        }
    }
    $user = new user();
    $user->setUser();
    $user->formIsCorrect();
    echo $user->email;
    echo $user->pswd;
?>