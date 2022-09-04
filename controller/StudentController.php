<?php 

namespace AppSch\Controller;
use AppSch\Validators\StringValidator;
use AppSch\Models\StudentModel;
use Exception;

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

      /*  if($stringValidator->isValid($name)){
            $this->setResultData("message", "Your name must be longer then three characters");
            return;
        }

        if($stringValidator->isValid($lastName)){
            $this->setResultData("message", "Your last name must be longer then three characters");
            return;
        }*/

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $studentModel = new StudentModel($this->getConnection());
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
}