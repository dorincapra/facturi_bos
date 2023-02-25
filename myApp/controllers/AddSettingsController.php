<?php

class AddSettingsController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
       

        $name = $_POST['name'];
        $cui = $_POST['cui'];
        $j = $_POST['j'];
        $location = $_POST['location'];
        $iban = $_POST['iban'];
        $bank = $_POST['bank'];
        $county = $_POST['county'];
        $country = $_POST['country'];
        $iban = $_POST['iban'];
        $bank = $_POST['bank'];
        $share_capital = $_POST['share_capital'];
        $mailing_address = $_POST['mailing_address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $web = $_POST['web'];
        $person = $_POST['person'];
        $position = $_POST['position'];
        $mobile = $_POST['mobile'];
        $observations = $_POST['observations'];
        $vat_rate = $_POST['vat_rate'];
        $invoice_series = $_POST['invoice_series'];
        $invoice_start = $_POST['invoice_start'];
        $invoice_end = $_POST['invoice_end'];
        $receipt_series = $_POST['receipt_series'];
        $receipt_start = $_POST['receipt_start'];
        $receipt_end = $_POST['receipt_end'];
        $emailp = $_POST['emailp'];
        $fax = $_POST['fax'];


        $setting = new SettingsModel;

        if($setting->addSetting($name,$cui, $j, $location, $county, $country, $iban, $bank, $share_capital, $mailing_address, $phone, $email, $web, $person, $position, $mobile, $observations, $vat_rate, $invoice_series, $invoice_start, $invoice_end, $receipt_series, $receipt_start, $receipt_end, $emailp, $fax)){
            sleep(2);
            header('Location: ?page=settings');
        } else {
            echo "error";
        }
    }
}
