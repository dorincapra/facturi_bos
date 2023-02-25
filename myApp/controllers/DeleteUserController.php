<?php

class DeleteUserController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $id = $_GET['id'];

        $user = new UsersModel;

        if($user->DelUser($id)){
            echo "userul a fost sters";
        } else {
             echo "n-a mers";
        }
        

       

    }
}
