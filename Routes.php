<?php 

return [
    \AppSch\Core\RouteCheck::get("|^user/registration/?$|"     , "User", "registrationGet"),
    \AppSch\Core\RouteCheck::post("|^user/registration/?$|"    , "User", "registrationPost"),
    \AppSch\Core\RouteCheck::get("|^.*$|", "Main", "index")
];