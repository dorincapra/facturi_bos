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


        
        //settings info
        $settings = new SettingsModel();

        $setting = $settings -> getSettings();
        $data['settingsName'] = $setting[0]['name'];
        $data['settingsCUI'] = $setting[0]['cui']; 
        $data['settingsJ'] = $setting[0]['j'];
        $data['settingsLocation'] = $setting[0]['location'];
        $data['settingsCounty'] = $setting[0]['county'];
        $data['settingsIBAN'] = $setting[0]['iban'];
        $data['settingsBank']= $setting[0]['bank'];
        $data['settingsCapital'] = $setting[0]['share_capital'];



        //invoice info
        $invoice = new InvoicesModel();
        $detaliiFactura = $invoice->getInvoiceDetails($data['invoiceID']);

        $data['series'] = $detaliiFactura[0]['series'];
        $wrongEmitDate = $detaliiFactura[0]["emitDate"];
        $data['emitDate'] = date("d-m-Y", strtotime($wrongEmitDate));
        $data['dueDate'] = date("d-m-Y", strtotime($detaliiFactura[0]["due_date"]));
        $data['currency'] = strtoupper($detaliiFactura[0]["currency"]);
        $data['value'] = $detaliiFactura[0]['value'];
        $data['totalVAT'] = $detaliiFactura[0]['totalValue'] - $detaliiFactura[0]['value'];
        $data['totalValue'] = $detaliiFactura[0]['totalValue'];
  
        


        //client info
        $clientID = $detaliiFactura[0]["clientID"];
        $client = new ClientsModel();
        $detaliiClient = $client->getClientDetails($clientID);
        $data['clientName'] = $detaliiClient[0]["name"];
        $data['clientLocation'] = $detaliiClient[0]["location"];
        $data['clientCUI'] = $detaliiClient[0]["CUI"];
        $data['clientJ'] = $detaliiClient[0]["J"];
        $data['clientIBAN'] = $detaliiClient[0]["iban"];
        $data['clientBank'] = $detaliiClient[0]["bank"];
        $data['clientJudet'] = $detaliiClient[0]["judet"];




        $content["content"] = $this->render(APP_PATH . VIEWS . 'editInvoicePage.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
