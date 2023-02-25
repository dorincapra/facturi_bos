<?php

class ShowTestPageController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {


      session_start();

      $data['username'] = $_SESSION['userName'];
      echo $this->render(APP_PATH . VIEWS . 'test.html', $data);
}
}
