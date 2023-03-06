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



        $data["invoiceID"] = $_GET['id'];
        $data["ammount"] = $_POST["ammount"];


        $invoiceDetails = $invoice->getInvoiceDetails($data['invoiceID']);

        $oldAmmountPaid = $invoiceDetails[0]['amm_paid'];
        $newAmmountPaid = $oldAmmountPaid + $data['ammount'];


        if ($invoice->payment($data['invoiceID'], $newAmmountPaid)) {
            if ($invoiceDetails[0]['totalValue'] > $newAmmountPaid && $newAmmountPaid > 0) {
                $invoice->correctStatus($data['invoiceID'], 3);
            } else if ($invoiceDetails[0]['totalValue'] == $newAmmountPaid && $invoiceDetails[0]['totalValue'] < $newAmmountPaid) {
                $invoice->correctStatus($data['invoiceID'], 2);
            }
        } else $data['test'] = " n-a mers";


        sleep(1);
        header("Location: ?page=invoices");


      
    }
}
