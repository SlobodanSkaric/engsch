<?php 

namespace AppSch\Controller;
session_start();
class MainController extends Controller{

    public function index(){
        $student = $_SESSION["student"] ?? false;
        $this->setResultData("messageses", $student);
    }
}