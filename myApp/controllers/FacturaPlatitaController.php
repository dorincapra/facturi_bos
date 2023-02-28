<?php

class FacturaPlatitaController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        session_start();

        if($_SESSION['userName']){
            $data['userName'] = $_SESSION['userName'];
        } else {
            header("Location: ?page=home");
        }


        $data['invoiceID'] = $_GET['id'];

        $invoice = new InvoicesModel();

        if($invoice->facturaPlatita($data['invoiceID'])){
            $data["error"] = "a mers";
        } else {
            $data["error"] = " n-a mers";
        }
   
       


        $content["content"] = $this->render(APP_PATH . VIEWS . 'test.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
