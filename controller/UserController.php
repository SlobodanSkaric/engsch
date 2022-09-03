<?php 

namespace AppSch\Controller;

class UserController extends Controller{
    public function registrationGet(){
        $this->setResultData("register", "Regisstration User");
    }

    public function registrationPost(){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $passwordag = filter_input(INPUT_POST, "passwordag", FILTER_SANITIZE_STRING);

        if($password != $passwordag){
            $this->setResultData("error", "You must enter the same password twice");
        }
    }
}