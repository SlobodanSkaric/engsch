<?php 

return [
    \AppSch\Core\RouteCheck::get("|^user/registration/?$|"             , "Student", "registrationGet"),
    \AppSch\Core\RouteCheck::post("|^user/registration/?$|"            , "Student", "registrationPost"),
    \AppSch\Core\RouteCheck::get("|^user/login/?$|"                    , "Student", "loginGet"),
    \AppSch\Core\RouteCheck::post("|^user/login/?$|"                   , "Student", "loginPost"),
    \AppSch\Core\RouteCheck::get("|^user/logout/?$|"                   , "Student", "logoutGet"),

    #student
    \AppSch\Core\RouteCheck::get("|^user/studentprofile/([0-9]+)/?$|"   , "Student", "profileGet"),
    \AppSch\Core\RouteCheck::get("|^user/studentprofiles/([0-9]+)/?$|"  , "StudentProfile", "profileGetSuccess"),
    \AppSch\Core\RouteCheck::get("|^user/studentinfo/?$|"      , "StudentInfo", "getInfo"),

    #profesor
    \AppSch\Core\RouteCheck::get("|^user/profesotprofile/?$|"          , "Profesor", "profileGet"),

    #admin
    \AppSch\Core\RouteCheck::get("|^user/admin/?$|"                    , "Admin", "dashbord"),

    #Api route
    \AppSch\Core\RouteCheck::get("|^user/phonestudentapi/([0-9]+)/([a-zA-Z0-9]+)/?$|"      , "ApiStudent", "setPhoneNumber"),
    \AppSch\Core\RouteCheck::get("|^user/studentapi/([0-9]+)/?$|"     , "ApiStudent", "getStudent"),

    \AppSch\Core\RouteCheck::get("|^.*$|", "Main", "index")
];