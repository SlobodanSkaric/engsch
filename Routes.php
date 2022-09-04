<?php 

return [
    \AppSch\Core\RouteCheck::get("|^user/registration/?$|"     , "Student", "registrationGet"),
    \AppSch\Core\RouteCheck::post("|^user/registration/?$|"    , "Student", "registrationPost"),
    \AppSch\Core\RouteCheck::get("|^user/login/?$|"            , "Student", "loginGet"),
    \AppSch\Core\RouteCheck::post("|^user/login/?$|"           , "Student", "loginPost"),
    \AppSch\Core\RouteCheck::get("|^user/logout/?$|"           , "Student", "logoutGet"),
    \AppSch\Core\RouteCheck::get("|^.*$|", "Main", "index")
];