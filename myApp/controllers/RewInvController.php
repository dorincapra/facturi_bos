<?php

class RewInvController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){


        $pret = $_POST['itemPrice'];

    
        $data['test'] = $pret;
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$data);
    }
}