<?php

class ShowCostsController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        session_start();

        if(isset($_SESSION['userName'])){
            $content['userName'] = $_SESSION['userName'];
        } else {
          header("Location: ?page=login");
        }
        
        


        $content["content"] = $this->render(APP_PATH . VIEWS . 'costspage.html');
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
    }
}
