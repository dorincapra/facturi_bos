<?php

class EditInvoiceController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {


        $data['invoiceID'] = $_GET['id'];

        $invoice = new InvoicesModel();

        //get all deets for invoice
        
        

        $content["content"] = $this->render(APP_PATH . VIEWS . 'test.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
