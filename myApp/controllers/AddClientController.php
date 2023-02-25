<?php

class AddClientController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $name = $_POST['name'];
        $location = $_POST['location'];
        $cui = $_POST['cui'];
        $j = $_POST['j'];
        $contactPers = $_POST['contactPers'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $iban = $_POST['iban'];

        $client = new ClientsModel;

        $data["erorr"] = "nu nimica";
 
        if($client->addClient($name, $cui, $j, $contactPers, $phone, $email, $location, $iban)){
            $data["error"] = "a mers";
        } else $data["error"] = "n-a mers";


        sleep(3);
        header('Location:?page=clients');
    }
}
