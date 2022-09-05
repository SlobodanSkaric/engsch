<?php 

return [
    \AppSch\Core\RouteCheck::get("|^user/registration/?$|"     , "Student", "registrationGet"),
    \AppSch\Core\RouteCheck::post("|^user/registration/?$|"    , "Student", "registrationPost"),
    \AppSch\Core\RouteCheck::get("|^user/login/?$|"            , "Student", "loginGet"),
    \AppSch\Core\RouteCheck::post("|^user/login/?$|"           , "Student", "loginPost"),
    \AppSch\Core\RouteCheck::get("|^user/logout/?$|"           , "Student", "logoutGet"),

    #student
    \AppSch\Core\RouteCheck::get("|^user/studentprofile/?$|"   , "Student", "profileGet"),

    #profesor
    \AppSch\Core\RouteCheck::get("|^user/profesotprofile/?$|"  , "Profesor", "profileGet"),

    #admin
    \AppSch\Core\RouteCheck::get("|^user/admin/?$|"            , "Admin", "dashbord"),

    \AppSch\Core\RouteCheck::get("|^.*$|", "Main", "index")
];