<?php

class EditPaymentController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {


      
        $invoice = new InvoicesModel();


        $data['invoiceID'] = $_POST['invoiceID'];
        $data['ammount'] = $_POST['ammount'];


        $invoiceDetails = $invoice->getInvoiceDetails($data['invoiceID']);

        $oldAmmountPaid = $invoiceDetails[0]['amm_paid'];
        $newAmmountPaid = $oldAmmountPaid + $data['ammount'];


        if($invoice->payment($data['invoiceID'], $newAmmountPaid)){
            $data['test'] = "a mers";
        } else $data['test'] = " n-a mers";

        $content["content"] = $this->render(APP_PATH . VIEWS . 'test.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
