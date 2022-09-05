<?php 

namespace AppSch\Controller;

use Collator;

class ProfesorController extends Controller{
    public function profileGet(){
        $profesorName = $_SESSION["profesor"] ?? false;
        if($profesorName == false) $profesorName = "Profesor name is not defined";
        $this->setResultData("message", $profesorName);
    }
}