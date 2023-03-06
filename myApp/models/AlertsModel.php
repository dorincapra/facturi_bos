<?php

class AlertsModel extends DBModel
{
    protected $name;
    protected $cui;
    protected $j;

    public function __construct($message = '')
    {
        $this->$message = $message; 
    }

    public function showAlert($message){
        echo "<script>alert('$message');</script>";
    }
}
