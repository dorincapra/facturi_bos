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

        $setting = new SettingsModel();

        $settings = $setting->getSettings();

        $data['companyName'] = $settings[0]['name'];
        
        $content["content"] = $this->render(APP_PATH.VIEWS.'homepage.html', $data);
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$content);
    }
}