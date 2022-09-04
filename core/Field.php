<?php 

namespace AppSch\Core;

class Field{
    private $validation;
    private $editabel;

    public function __construct(Validator $validator, $editable){
        $this->validation = $validator;
        $this->editabel = $editable;
    }

    public function isValid($value){
        return $this->validation->isValid($value);
    }

    public function isEditable(){
        return $this->editabel;
    }
}