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



        $data["invoiceID"] = $_POST["invoiceID"];
        $data["ammount"] = $_POST["ammount"];


        $invoiceDetails = $invoice->getInvoiceDetails($data['invoiceID']);

        $oldAmmountPaid = $invoiceDetails[0]['amm_paid'];
        $newAmmountPaid = $oldAmmountPaid + $data['ammount'];


        if($invoice->payment($data['invoiceID'], $newAmmountPaid)){
            $data['test'] = "a mers";
        } else $data['test'] = " n-a mers";

        sleep(1);
        header("Location: ?page=invoices");
}

}
