<?php 

namespace AppSch\Controller;

use AppSch\Validators\StringValidator;
use AppSch\Models\StudentModel;
use Exception;
use AppSch\Models\GroupschModel;
class StudentController extends Controller{
    public function registrationGet(){
        $model = new StudentModel($this->getConnection());
        $this->setResultData("register", "Regisstration User");
    }

    public function registrationPost(){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $group = filter_input(INPUT_POST, "group", FILTER_SANITIZE_STRING);
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
        
        $groupModel = new GroupschModel($this->getConnection());
        $groupResult = $groupModel->getFildName("groupname", $group);
        $grouId = $groupResult->group_id ?? "";

        if(!$groupResult){
            $this->setResultData("message", "Please slect group");
            return;
        }

        try{
            $add = $studentModel->add([
                "name"        => $name,
                "lastname"    => $lastName,
                "email"       => $email,
                "teach_group"    => $grouId,
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

        
        $_SESSION["student"]       = $existeEmail->name;
        $_SESSION["student_email"] = $existeEmail->email;
        $_SESSION["student_id"]    = $existeEmail->student_id;

        $this->setResultData("message", $existeEmail->name);

        if($existeEmail->phonenumber === null){
            $this->redirect("/engsch/user/studentprofile/".$existeEmail->student_id);
            return;
        }

        $this->redirect("/engsch/user/studentprofiles/".$existeEmail->student_id);
    }

    public function profileGet($id){
        $studentName = $_SESSION["student"] ?? false;
        setcookie("sudentname", $studentName, time() + (86400 * 30), "/");

        $studentModel = new StudentModel($this->getConnection());
        $student = $studentModel->getFildName("student_id", $id);
        
        if($student){
            $this->setResultData("name", $studentName);
            $this->setResultData("student", $id);
            return;
        }

        $this->setResultData("message", "Try again login");
    }

    //run when call api student

    public function logoutGet(){
        $this->logout();
        $this->redirect("/engsch/user/");
    }

}