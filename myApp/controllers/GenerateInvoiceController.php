<?php

use Dompdf\Dompdf;


class GenerateInvoiceController extends AppController {
    public function __construct(){
        $this->init();
    }

    public function init(){



        $invoice = new InvoicesModel;
        $client = new ClientsModel;
        $item = new ItemsModel;
        $settings = new SettingsModel;


        $invoiceID = $_GET['id'];

        $detaliiFactura = $invoice->getInvoiceDetails($invoiceID);
        $clientID = $detaliiFactura[0]["clientID"];
        $value = $detaliiFactura[0]["value"];
        $serieFactura = $detaliiFactura[0]["series"];


//client info
        $detaliiClient = $client->getClientDetails($clientID);
        $data['clientName'] = $detaliiClient[0]["name"];
        $data['clientLocation'] = $detaliiClient[0]["location"];
        $data['clientCUI'] = $detaliiClient[0]["CUI"];
        $data['clientJ'] = $detaliiClient[0]["J"];
        $data['clientIBAN'] = $detaliiClient[0]["iban"];
        $data['clientBank'] = $detaliiClient[0]["bank"];
        $data['clientJudet'] = $detaliiClient[0]["judet"];



//produse info
        $data['totalVAT'] = 0;
        $data['totalItems'] = 0;
        $nrCrt = 0;
        $data['totalGeneral'] = 0;

        $data['productsTable'] = '';
        $itemsDetails = $item->getItemDetailsByInvoice($invoiceID);
        foreach($itemsDetails as $item){

            $nrCrt += 1;
            $VATValue = $item['vat']/$item['quantity'];
            $totalValueWVAt = $item['quantity'] * $item['unitPrice'];

           
        $data['productsTable'] .= "<tr>
        <td style='text-align: center'>" . $nrCrt ."</td>
        <td style='text-align: center'>" . $item['description'] .      
        "</td>
        <td style='text-align: center'>buc.</td>
        <td style='text-align: center'>" . $item['quantity'] . "</td>
        <td style='text-align: center'>". $item['unitPrice']  . "</td>
        <td style='text-align: center'>" .  $totalValueWVAt . "</td>
        <td style='text-align: center'>" . $VATValue . "</td>
      </tr>";}


      //invoice info
      $data['nrSerieFactura'] = $serieFactura . "-" . $invoiceID;
      $wrongEmitDate = $detaliiFactura[0]["emitDate"];
      $data['emitDate'] = date("d-m-Y", strtotime($wrongEmitDate));
      $data['dueDate'] = date("d-m-Y", strtotime($detaliiFactura[0]["due_date"]));
      $data['currency'] = strtoupper($detaliiFactura[0]["currency"]);
     
      $data['value'] = $detaliiFactura[0]['value'];
      $data['totalVAT'] = $detaliiFactura[0]['totalValue'] - $detaliiFactura[0]['value'];
      $data['totalValue'] = $detaliiFactura[0]['totalValue'];


//settings info
            $settingsInfo = $settings->getSettings();
            $data['settingsName'] = $settingsInfo[0]['name'];
            $data['settingsCUI'] = $settingsInfo[0]['cui'];
            $data['settingsJ'] = $settingsInfo[0]['j'];
            $data['settingsLocation'] = $settingsInfo[0]['location'];
            $data['settingsCounty'] = $settingsInfo[0]['county'];
            $data['settingsIBAN'] = $settingsInfo[0]['iban'];
            $data['settingsBank'] = $settingsInfo[0]['bank'];
            $data['settingsCapital'] = $settingsInfo[0]['share_capital'];


         
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->render(APP_PATH.VIEWS.'invoiceTemplate.html',$data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($data['nrSerieFactura']);


      
        // $content['test'] = var_dump($settingsInfo);

        //  echo $this->render(APP_PATH . VIEWS . 'test.html', $content);


    }
}