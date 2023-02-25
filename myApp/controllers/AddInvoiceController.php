<?php

class AddInvoiceController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $invoice = new InvoicesModel();
        $item = new ItemsModel();
        $client = new ClientsModel();

        $series = $_POST['series'];
        $nrFactura = $_POST['number'];
        $emitDate = date('Y-m-d', strtotime($_POST['emitDate']));
        $currency = $_POST['currency'];

        $lastInvoiceID = '';
        $value = NULL;
        $status = 1;
        $totalValue = NULL;
        $totalVat = NULL;

        $data['test'] = '';


        $nrProduse = count($_POST['product_name']);

        for($i=0; $i<$nrProduse; $i++){
            $prodPrice = $_POST['product_price'][$i];
            $prodQty = $_POST['product_qty'][$i];
            $prodVat = $_POST['product_vat'][$i];

            $value += $prodPrice * $prodQty;
            
            $totalVat = $value * $prodVat/100;

        }

         $totalValue = $value + $totalVat;



          //client info
          $clientName = $_POST['clientName'];
          $clientCUI = $_POST['clientCUI'];
          $clientJ = $_POST['clientJ'];
          $clientLocation = $_POST['clientLocation'];
          $clientIBAN = $_POST['clientIBAN'];
          $clientContactP = $_POST['clientContactP'];
          $clientPhone = $_POST['clientPhone'];
          $clientEmail = $_POST['clientEmail'];
        //   $clientBank = $_POST['clientBank'];
        //   $clientJudet = $_POST['clientJudet'];

          if($client->addClient($clientName, $clientCUI, $clientJ, $clientContactP, $clientPhone, $clientEmail, $clientLocation, $clientIBAN)){
          $clientID = $client->lastClientID()[0][0];}
          else {$data['test']="n-a mers la client";}
          
        

        $item_type = $_POST['item_type'];
        $recruited_job = $_POST['recruited_job'];
        $agent = $_POST['agent'];
        $due_date = date("Y-m-d", strtotime($_POST['emitDate'] . "+ 5 days"));

        if($invoice->addInvoice($clientID, $series, $value, $totalValue, $currency, $status, $emitDate, $item_type, $recruited_job, $agent, $due_date)){
            $lastInvoiceID = $invoice->lastInvoiceID()[0][0];
        } else $data['test'] = ' n-a mers';
     
            //ADD ITEMS LOGIC
        // 

            for($i=0; $i<$nrProduse; $i++){
            $prodName = $_POST['product_name'][$i];
            $prodPrice = $_POST['product_price'][$i];
            $prodQty = $_POST['product_qty'][$i];
            
            $procentVat = $_POST['product_vat'][$i];

            $prodVat = $prodPrice * $procentVat/100 * $prodQty;

            if($item->addItem($prodName, $lastInvoiceID, $prodPrice, $prodVat, $prodQty))
            header('Location: ?page=invoices'); 
        
            else {$data['test'] .= "A aparut o eroare";}
        }



        //get info from invoice form 
        //get value and quantity of items - calculate the total price for invoice
        //calculate total with and without VAT
        //create the invoice and get id 
        //add the items in BD with the invoiceID 

            
        

        
    
       



        // $content["content"] = $this->render(APP_PATH . VIEWS . 'test.html', $data);
        // echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
        

     


    }
}


