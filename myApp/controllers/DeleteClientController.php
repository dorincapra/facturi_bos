<?php

class DeleteClientController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $id = $_GET['id'];

        $client = new ClientsModel();

        if($client->delClient($id)){
            echo "userul a fost sters";
        } else {
             echo "n-a mers";
        }
        

       

    }
}
