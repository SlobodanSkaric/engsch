<?php 

namespace AppSch\Core\Role;

use AppSch\Controller\Controller;
use AppSch\Core\Fingerprint\BasicFingerprint;
use AppSch\Core\Fingerprint\FingerprintFactory;
class StudentRole extends Controller{
    public function _pre(){
        $studentId = $_SESSION["student_id"];
        
        if($studentId === null){
            $this->redirect("/engsch/user/login");
        }
    }

    public function fingerValidate($source){
         $fingerprintFactory = new FingerprintFactory();
         $fingerprintInstance = $fingerprintFactory->getInstance($source);
         $fingerprint = $fingerprintInstance->fingerprint();

        $_SESSION["fingerprint"] = $fingerprint;
        setcookie("fingerprint", $fingerprint, time() + (86400 * 30) , "/");
    }
}