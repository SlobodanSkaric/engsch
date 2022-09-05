<?php 

namespace AppSch\Controller;

class AdminController extends Controller{
    public function dashbord(){
        $this->setResultData("message", "Admin dashbord");
    }
}