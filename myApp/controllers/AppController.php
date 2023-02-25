<?php

class AppController
{

    protected $routes = [
                            'home' => 'HomeNAuthController',
                            'login' => 'LoginController',
                            'authenticate' => 'AuthController',
                            'logout' => 'LogoutController',
                            'users' => 'ShowUsersController',
                            'invoices' => 'ShowInvoicesController',
                            'clients' => 'ShowClientsController',
                            'costs' => 'ShowCostsController',
                            'settings' => 'ShowSettingsPageController',
                            'genInv' => 'GenerateInvoiceController',
                            'addInv' => 'AddInvoiceController',
                            'addUser' => 'AddUserController',
                            'delUser' => 'DeleteUserController',
                            'addClient' => 'AddClientController',
                            'test' => 'ShowTestPageController',
                            'addSetting' => 'AddSettingsController',
                            'editInvoiceForm' => 'EditInvoiceFormController',
                            'editClientForm' => 'EditClientFormController',
                            'editInvoice' => 'EditInvoiceController',
                            'editPayment'=> 'EditPaymentController',
                            'editClient' => 'EditClientController',
                            'delClient' => 'DeleteClientController'
                            
                        ];

    public function __construct(){
        $this->init();
    }

    public function init(){
        // redirectarea, navigarea între pagini

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else {
            $page = 'login';
        }

        if(array_key_exists($page, $this->routes)){
            $className = $this->routes[$page];
        }
        else {
            $className = $this->routes['login'];
        }
        new $className;
    }

    public function render($page, $data=array()){
        $template = file_get_contents($page);
            
        // caută toate placeholerele
        preg_match_all("[{{\w+}}]", $template, $matches);

        // var_dump($matches[0]);

        foreach($matches[0] as $value){
            // scoate toate acoladele
            // înlocuiește-le cu informația din array-ul data
            $item = str_replace('{{', '', $value);
            $item = str_replace('}}', '', $item);

            if(array_key_exists($item, $data)){
                $template = str_replace($value, $data[$item], $template);
            }
        }
        return $template;
    }

}