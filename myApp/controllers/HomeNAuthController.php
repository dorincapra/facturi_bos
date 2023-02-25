<?php

class HomeNAuthController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){



        session_start();

        if(isset($_SESSION['userName'])){
            $data['userName'] = $_SESSION['userName'];
        } else {
          header("Location: ?page=login");
        }
        
        $data["content"] = $this->render(APP_PATH.VIEWS.'homepage.html');
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$data);
    }
}