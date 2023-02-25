<?php

class EditInvoiceFormController extends AppController
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

        //get all deets for invoice
        
        

        $content["content"] = $this->render(APP_PATH . VIEWS . 'editInvoicePage.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
