<?php
    require 'app/models/User.Model.php';

    class UserController{

        private $userModel;

        public function __construct()
        {   
            $this->userModel = new UserModel();
            
        }
        

        public function registerUser($vars) {
            $id = $vars["id"] ?? '';
            $this->userModel->register($_POST, $id);
        }
    }
?>