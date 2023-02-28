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
        //get all deets for invoice from form

        $invoice = new InvoicesModel();
        $detaliiFactura = $invoice->getInvoiceDetails($data['invoiceID']);
        $data['series'] = $detaliiFactura[0]['series'];
        $wrongEmitDate = $detaliiFactura[0]["emitDate"];
        $data['emitDate'] = date("Y-m-d", strtotime($wrongEmitDate));
        $data['dueDate'] = date("Y-m-d", strtotime($detaliiFactura[0]["due_date"]));
        $data['currency'] = strtoupper($detaliiFactura[0]["currency"]);
        $data['value'] = $detaliiFactura[0]['value'];
        $data['totalVAT'] = $detaliiFactura[0]['totalValue'] - $detaliiFactura[0]['value'];
        $data['totalValue'] = $detaliiFactura[0]['totalValue'];
  
        

      




        $content["content"] = $this->render(APP_PATH . VIEWS . 'test.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
