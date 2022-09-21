<?php 

namespace AppSch\Controller;

use AppSch\Core\Role\StudentRole;
use AppSch\Models\StudentModel;
use AppSch\Core\Fingerprint\FingerprintFactory;
class StudentProfileController extends StudentRole{
    public function profileGetSuccess($id){
        $this->fingerValidate("SERVER");
        $studentModel = new StudentModel($this->getConnection());
        $student = $studentModel->getFildName("student_id", $id);

        if($student->email == $_SESSION["student_email"]){
            
            $this->setResultData("studentName", "{$student->name}");
            $this->setResultData("studentLastname", "{$student->lastname}");
            setcookie("student_id", $student->student_id, time() + (86400 * 30), "/");
        }

    }
}