<?php 

namespace AppSch\Validators;

use AppSch\Core\Validator;

class NumberValidator implements Validator{
    private $maxLength;

    public function __construct(){
        $this->maxLength = 10;
    }

    public function setMaxInt(int $number):NumberValidator{
        $this->maxLength = $number;
        return $this;
    }
    public function isValid(string $value): bool {
        $preg = "/^";

        $preg .= "[1-9]{0,". $this->maxLength ."}";

        $preg .= "$/";

        return boolval(preg_match($preg, $value));
    }
}