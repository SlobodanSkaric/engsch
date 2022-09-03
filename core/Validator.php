<?php 

namespace AppSch\Core;

interface Validator{
    public function isValid(string $value):bool;
}