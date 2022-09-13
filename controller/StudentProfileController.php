<?php 

namespace AppSch\Controller;

use Collator;
use AppSch\Models\StudentModel;
session_start();
class StudentProfileController extends Controller{
    public function profileGetSuccess($id){
        $studentModel = new StudentModel($this->getConnection());
        $studentId = $_SESSION["student_id"];
        $student = $studentModel->getFildName("student_id", $studentId);

        if($student->email == $_SESSION["student_email"]){
            $this->getData("student", $student->name);
        }
    }
}