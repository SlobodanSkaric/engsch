<?php 

namespace AppSch\Controller;

class MainController extends Controller{

    public function index(){
        $this->setResultData("exempledata", "This is example text");
    }
}