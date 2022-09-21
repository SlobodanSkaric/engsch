<?php 

namespace AppSch\Core\Fingerprint;

class BasicFingerprint implements Fingerprint{
    private $source;

    public function __construct(array $src){
        $this->source = $src;
    }
    public function fingerprint(){
        $userAgent = filter_var($this->source["HTTP_USER_AGENT"] ?? "", FILTER_SANITIZE_STRING);
        $ipAddr = filter_var($this->source["REMOTE_ADDR"] ?? "" , FILTER_SANITIZE_STRING);
        $conc = $userAgent . "&" . $ipAddr;

        $fingerprint = hash("sha512", $conc);

        return hash("sha512", $fingerprint);
    }
}