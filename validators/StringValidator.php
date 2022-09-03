<?php 

namespace AppSch\Validators;

use AppSch\Core\Validator;

class StringValidator implements Validator{
    private int $minNum;
    private int $maxNum;

    public function __construct(){
        $this->minNum = 3;
        $this->maxNum = 256;
    }

    public function setMin(int $minVal){
        $this->minNum = $minVal;
        return $this;
    }

    public function setMax(int $maxVal){
        $this->maxNum = $maxVal;
        return $this;
    }

    public function isValid(string $value): bool{
        $valueLen = strlen($value);

        return boolval($valueLen < $this->minNum || $valueLen > $this->maxNum);
    }
}