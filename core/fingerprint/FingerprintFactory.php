<?php 

namespace AppSch\Core\Fingerprint;

class FingerprintFactory{
    public function getInstance(string $source){
        switch($source){
            case "SERVER":
                return new BasicFingerprint($_SERVER);
        }
    }
}