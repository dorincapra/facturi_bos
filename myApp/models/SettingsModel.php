<?php

class SettingsModel extends DBModel
{
        protected $name;
        protected $cui;
        protected $j;
        protected $location ;
        protected $iban;
        protected $bank;
        protected $share_capital;
        protected $mailing_address;
        protected $phone;
        protected $email;
        protected $person;
        protected $position;
        protected $observations;
        protected $vat_rate;
        protected $invoice_series;
        protected $invoice_start;
        protected $invoice_end;
        protected $receipt_series;
        protected $receipt_start;
        protected $receipt_end;
        protected $emailp;
        protected $fax;
        protected $web;
    

    public function __construct($name='', $cui='', $j='', $location='', $iban='', $bank='', $share_capital='', $mailing_address='', $phone='', $email='', $web='', $person='', $position='', $observations='', $vat_rate='', $invoice_series='', $invoice_start='', $invoice_end='',$receipt_series='', $receipt_start='', $receipt_end='', $emailp='', $fax=''){
        $this->name = $name;
        $this->cui = $cui;
        $this->j = $j;
        $this->location = $location;
        $this->iban = $iban;
        $this->bank = $bank;
        $this->share_capital = $share_capital;
        $this->mailing_address = $mailing_address;
        $this->phone = $phone;
        $this->email = $email;
        $this->web = $web;
        $this->person = $person;
        $this->position = $position;
        $this->observations = $observations;
        $this->vat_rate = $vat_rate;
        $this->invoice_series = $invoice_series;
        $this->invoice_start = $invoice_start;
        $this->invoice_end = $invoice_end;
        $this->receipt_series = $receipt_series;
        $this->receipt_start = $receipt_start;
        $this->receipt_end = $receipt_end;
        $this->emailp = $emailp;
        $this->fax = $fax;
  
        
    }


    public function addSetting($name, $cui, $j, $location, $county, $country, $iban, $bank, $share_capital, $mailing_address, $phone, $email, $web, $person, $position, $mobile, $observations, $vat_rate, $invoice_series, $invoice_start, $invoice_end, $receipt_series, $receipt_start, $receipt_end, $emailp, $fax){
        $q = "INSERT INTO `settings`(`name`, `cui`, `j`, `location`,`county`,`country`,`iban`, `bank`, `share_capital`, `mailing_address`, `phone`, `email`, `web`, `person`, `position`, `mobile`, `observations`, `vat_rate`, `invoice_series`, `invoice_start`, `invoice_end`, `receipt_series`, `receipt_start`, `receipt_end`, `emailp`, `fax`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ;";
         $myPrep = $this->db()->prepare($q);
         $myPrep->bind_param("ssssssssissssssssisiisiiss", $name, $cui, $j, $location, $county, $country, $iban, $bank, $share_capital, $mailing_address, $phone, $email, $web, $person, $position, $mobile, $observations, $vat_rate, $invoice_series, $invoice_start, $invoice_end, $receipt_series, $receipt_start, $receipt_end, $emailp, $fax);
         return $myPrep->execute();
    }

    public function getSettings(){
        $q = "SELECT * FROM `settings` ORDER BY `id` DESC LIMIT 1";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}