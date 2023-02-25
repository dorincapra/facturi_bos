<?php

class AuthController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {


        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new UsersModel;

        $data["username"] = $username;
        $data["password"] = $password;

        if ($user->isAuth($username, $password)) {

            session_start();
            $_SESSION["userName"] = $username;

            // $data["content"] = $this->render(APP_PATH . VIEWS . 'homepage.html');
            // echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$data);

            header('Location: ?page=home');

        //     echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $data);
        // } else {
        //     $data["mesaj"] = "ai gresit user/pass, incearca din nou";
        //     echo $this->render(APP_PATH . VIEWS . 'failedloginpage.html', $data);
        // }

  

        }
    }
}
