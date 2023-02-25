<?php

class ShowSettingsPageController extends AppController 
{
    public function __construct(){
        $this->init();
    }

    public function init(){


        session_start();

        if(isset($_SESSION['userName'])){
            $data['userName'] = $_SESSION['userName'];
        } else {
          header("Location: ?page=login");
        }
        

        $data=[];

        $setting = new SettingsModel();

        $settingsDetails = $setting->getSettings();

        $data['name']=$settingsDetails[0]['name'];
        $data['cui']=$settingsDetails[0]['cui'];
        $data['j']=$settingsDetails[0]['j'];
        $data['location']=$settingsDetails[0]['location'];
        $data['county'] = $settingsDetails[0]['county'];
        $data['country'] = $settingsDetails[0]['country'];
        $data['iban']=$settingsDetails[0]['iban'];
        $data['bank']=$settingsDetails[0]['bank'];
        $data['share_capital']=$settingsDetails[0]['share_capital'];
        $data['mailing_address']=$settingsDetails[0]['mailing_address'];
        $data['phone']=$settingsDetails[0]['phone'];
        $data['email']=$settingsDetails[0]['email'];
        $data['person']=$settingsDetails[0]['person'];
        $data['position']=$settingsDetails[0]['position'];
        $data['observations']=$settingsDetails[0]['observations'];
        $data['vat_rate']=$settingsDetails[0]['vat_rate'];
        $data['invoice_series']=$settingsDetails[0]['invoice_series'];
        $data['invoice_start']=$settingsDetails[0]['invoice_start'];
        $data['invoice_end']=$settingsDetails[0]['invoice_end'];
        $data['receipt_series']=$settingsDetails[0]['receipt_series'];
        $data['receipt_start']=$settingsDetails[0]['receipt_start'];
        $data['receipt_end']=$settingsDetails[0]['receipt_end'];
        $data['emailp']=$settingsDetails[0]['emailp'];
        $data['fax']=$settingsDetails[0]['fax'];
        $data['web']=$settingsDetails[0]['web'];
        $data['county'] = $settingsDetails[0]['county'];
        $data['mobile'] = $settingsDetails[0]['mobile'];


        $content["content"] = $this->render(APP_PATH.VIEWS.'settingspage.html', $data);
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$content);
    }

}