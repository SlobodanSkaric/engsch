<?php 

namespace AppSch\Core\Role;

use AppSch\Controller\Controller;
class StudentRole extends Controller{
    public function _pre(){
        $studentId = $_SESSION["student_id"];
        
        if($studentId === null){
            $this->redirect("/engsch/user/login");
        }
    }
}