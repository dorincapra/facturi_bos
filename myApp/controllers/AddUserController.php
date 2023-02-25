<?php

class AddUserController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        if(isset($_POST["level"])){
            $level = $_POST["level"];
        } else {
            $level = 1;
        }
        $userName = $_POST["userName"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];

        

        $user = new UsersModel();
        $data['error'] = '';


       if(!$user->checkDoubleUser($userName)){
        if ($user->addUser($name, $userName, $email, $phone, $password, $level)) {
            //show "userul a fost adaugat cu success" for 3 sec 
            //then redirect to "Users" page
            $data['error'] = "a mers";
        } else {
            //show "userul NU a fost adaugat, contacteaza developerul" for 3 sec 
            //then redirect to "Users" page
            $data['error'] = "n-a mers";
        }
       }  

        sleep(2);
        header("Location: ?page=users");

    }
}
