<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }      
        
        public function login($username, $password)
        {

            // logic



            header("location:" .FRONT_ROOT . "Student/ShowAddView");
        }
    }
?>