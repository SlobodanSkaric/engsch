<?php 

namespace AppSch\Controller;

use AppSch\Core\ApiController;
use AppSch\Models\StudentModel;

class ApiStudentController extends ApiController{

    public function getStudent($student){
        $studentModel = new StudentModel($this->getConnection());
        $studentGet = $studentModel->getFildName("student_id",$student);
        
        $this->setResultData("student", $studentGet);
    }
    public function setPhoneNumber($studentId, $phoneNumber){
        $student = new StudentModel($this->getConnection());
        $student = $student->edit($studentId,[
            "phonenumber" => $phoneNumber
        ]);

        $this->setResultData("student", "update");
    }
}