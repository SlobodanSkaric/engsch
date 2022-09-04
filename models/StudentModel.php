<?php 

namespace AppSch\Models;
use AppSch\Core\Field;
use AppSch\Validators\NumberValidator;
use AppSch\Validators\StringValidator;

class StudentModel extends Model{
    public function getFields(){
        return [
            "name"        => new Field((new StringValidator())->setMin(3)->setMax(30),true),
            "lastname"    => new Field((new StringValidator())->setMin(3)->setMax(30),true),
            "email"       => new Field((new StringValidator())->setMin(3)->setMax(30),true),
            "phonenumber" => new Field((new StringValidator())->setMin(3)->setMax(30),true),
            "password"    => new Field((new StringValidator())->setMin(3)->setMax(120),true),
            "approved"    => new Field((new NumberValidator())->setMaxInt(1),true),
        ];
    }

}