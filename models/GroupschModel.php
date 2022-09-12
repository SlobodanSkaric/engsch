<?php 

namespace AppSch\Models;
use AppSch\Core\Field;
use AppSch\Validators\NumberValidator;
use AppSch\Validators\StringValidator;

class GroupschModel extends Model{
    public function getFields(){
        return [
            "group_id"  => new Field((new NumberValidator())->setMaxInt(11),false),
            "groupname" => new Field((new StringValidator())->setMin(1)->setMax(6), true),
            "title"     => new Field((new StringValidator())->setMin(3)->setMax(100), true)
        ];
    }
}