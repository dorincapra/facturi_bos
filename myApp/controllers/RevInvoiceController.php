<?php

class RevInvoiceController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $content["content"] = $this->render(APP_PATH.VIEWS.'revInvoicePage.html');
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html', $content);
    }
}
