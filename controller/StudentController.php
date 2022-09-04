<?php 

namespace AppSch\Controller;
use AppSch\Validators\StringValidator;
use AppSch\Models\StudentModel;
use Exception;

session_start();
class StudentController extends Controller{
    public function registrationGet(){
        $model = new StudentModel($this->getConnection());
        $this->setResultData("register", "Regisstration User");
    }

    public function registrationPost(){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $passwordag = filter_input(INPUT_POST, "passwordag", FILTER_SANITIZE_STRING);

        $approvedDefault = 1;

        $stringValidator = (new StringValidator())->setMin(3)->setMax(30);

        if($password != $passwordag){
            $this->setResultData("message", "You must enter the same password twice");
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $studentModel = new StudentModel($this->getConnection());
        $checkStudentEmailExiste = $studentModel->getFildName("email", $email);

        if($checkStudentEmailExiste){
            $this->setResultData("message", "User with this eamil already exists");
            return;
        }

        try{
            $add = $studentModel->add([
                "name"        => $name,
                "lastname"    => $lastName,
                "email"       => $email,
                "phonenumber" => $phone,
                "password"    => $passwordHash,
                "approved"    => $approvedDefault,
            ]);
            if($add){
                $this->setResultData("message", "Is register");
            }
        }catch(Exception $e){
            $this->setResultData("message", "Please chekc your data. Error: " . $e->getMessage());
        }
    }

    public function loginGet(){

    }

    public function loginPost(){
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        $studentModel = new StudentModel($this->getConnection());
        $existeEmail = $studentModel->getFildName("email", $email);

        if(!$existeEmail){
            $this->setResultData("message", "This email not exists");
            return;
        }

        $passwordHash = $existeEmail->password;

        if(!password_verify($password,$passwordHash)){
            $this->setResultData("message", "Password is not valid");
            return;
        }

        
        $_SESSION["student"] = $existeEmail->name;

        $this->setResultData("message", $existeEmail->name);

        $this->redirect("/engsch/user/");
    }

    public function logoutGet(){
        $this->logout();
        $this->redirect("/engsch/user/");
    }
}