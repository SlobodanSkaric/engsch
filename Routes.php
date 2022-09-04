<?php 

return [
    \AppSch\Core\RouteCheck::get("|^user/registration/?$|"     , "Student", "registrationGet"),
    \AppSch\Core\RouteCheck::post("|^user/registration/?$|"    , "Student", "registrationPost"),
    \AppSch\Core\RouteCheck::get("|^.*$|", "Main", "index")
];