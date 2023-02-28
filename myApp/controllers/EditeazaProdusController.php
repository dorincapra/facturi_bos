<?php

class EditeazaProdusController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $data['error'] = 2;
       
        
        $data['invoiceID'] = $_GET['id'];

        $item = new ItemsModel();
        $invoice = new InvoicesModel();

        $value = NULL;
        $status = 1;
        $totalValue = NULL;
        $totalVat = NULL;

        $nrProduse = count($_POST['product_name']);

  


         //sterge produse
         if(!$item->deleteItemsFromInvoice($data['invoiceID']))
            $data['error'] = "n-a mers stergerea";

        //adaugare produse noi
        for($i=0; $i<$nrProduse; $i++){
            $prodName = $_POST['product_name'][$i];
            $prodPrice = $_POST['product_price'][$i];
            $prodQty = $_POST['product_qty'][$i];
            $procentVat = $_POST['product_vat'][$i];
            if($prodName!='' && $prodPrice != '' && $prodQty != '' && $procentVat != ''){
                $prodVat = intval($prodPrice) * intval($procentVat)/100 * intval($prodQty);
                if(!$item->addItem($prodName, $data['invoiceID'], $prodPrice, $prodVat, $prodQty))
                    $data['test'] .= "nu a mers adaugarea in BD";
            }

           
        }


        for($i=0; $i<$nrProduse; $i++){
            $prodPrice = $_POST['product_price'][$i];
            $prodQty = $_POST['product_qty'][$i];
            $prodVat = $_POST['product_vat'][$i];

            $value += $prodPrice * $prodQty;
            
            $totalVat = $value * $prodVat/100;

        }

         $totalValue = $value + $totalVat;

        if($invoice->updateInvoice(intval($data['invoiceID']), intval($value), intval($totalValue))){
            $data['error'] = " a mers";
        }    else $data['error'] = "n-a mers";

        $data['value'] = $value;
        $data['totalValue'] = $totalValue;

       $content["content"] = $this->render(APP_PATH.VIEWS.'test.html',$data);
       echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$content);

       
}

}
