<?php

class LogoutController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        session_start();
        session_unset();
        session_destroy();

        header('Location: ?page=login');

    }
}


