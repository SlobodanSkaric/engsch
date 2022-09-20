<?php 

namespace AppSch\Controller;

use AppSch\Core\Role\StudentRole;
use AppSch\Models\StudentModel;

session_start();

class StudentProfileController extends StudentRole{
    public function profileGetSuccess($id){
        $studentModel = new StudentModel($this->getConnection());
        $student = $studentModel->getFildName("student_id", $id);

        if($student->email == $_SESSION["student_email"]){
            $this->setResultData("studentName", "{$student->name}");
            $this->setResultData("studentLastname", "{$student->lastname}");
        }
    }
}