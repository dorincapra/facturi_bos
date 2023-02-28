<?php

class ShowInvoicesController extends AppController 
{
    public function __construct(){
        $this->init();
    }

    public function init(){


      session_start();

      if(isset($_SESSION['userName'])){
        $content['userName'] = $_SESSION['userName'];
    } else {
      header("Location: ?page=login");
    }
    

        $invoice = new InvoicesModel();
        $client = new ClientsModel();

        $data['invoicesTableContent'] = "";


        $settings = new SettingsModel();





        //FILTERS

        if(isset($_POST['nrFactura'])||isset($_POST['emitedFrom'])||isset($_POST['emitedUntil'])||isset($_POST['invoiceStatus'])||isset($_POST['termFrom'])||isset($_POST['termUntil'])||isset($_POST['signed'])||isset($_POST['paidFrom'])||isset($_POST['paidUntil'])||isset($_POST['currency'])||isset($_POST['agent'])||isset($_POST['paid'])||isset($_POST['not_paid'])||isset($_POST['part_paid']))
        {
          $q = "SELECT * FROM `invoices` WHERE `id`> 1";

          if($_POST['nrFactura']!= ""){
            $q .= " AND `id` = " . $_POST['nrFactura'];
          }

          if($_POST['emitedFrom']!=""){
          $emitedFrom = date('Ymd', strtotime($_POST['emitedFrom']));           
          $q .= " AND `emitDate` >= " . $emitedFrom;

          }

          if($_POST['emitedUntil']!=""){
            $emitedUntil = date('Ymd', strtotime($_POST['emitedUntil']));           
            $q .= " AND `emitDate` <= " . $emitedUntil;
          }

          if($_POST['termFrom']!=""){
            $term_from = date('Ymd', strtotime($_POST['termFrom']));           
            $q .= " AND `due_date` >= " . $term_from;
          }
  
          if($_POST['termUntil']!=""){
            $term_until = date('Ymd', strtotime($_POST['termUntil']));           
            $q .= " AND `due_date` <= " . $term_until;
          }

          // if(isset($_POST['currency'])){
          //   $q .= "AND `currency` = " . $_POST['currency'];
          // }

          if(isset($_POST['agent'])){
           $q .= " AND `agent` = '" . $_POST['agent'] ."'";
          }

         // echo var_dump($q);
          $invoices = $invoice->filterInvoices($q);

          
        } else {
          $invoices = $invoice->displayInvoices();
        }

       




      //display agents in filters
      $agents = $invoice -> getUsers();
      $data['agents'] = '';

      foreach($agents as $agent){
        $data['agents'] .= " <li class=flex items-center w-full py-1 text-sm>
        <input type=radio name='agent' value = '". $agent[0] ."'   class=mr-1 />
        <p>". $agent[0] ."</p>
      </li>";
   
      }



       

                //display invoices
        foreach($invoices as $invoice){
          $clientDetails = $client->getClientDetails($invoice["clientID"]);


            $data["invoicesTableContent"] .= "<tr class='bg-white even:bg-sky-50 border-b mx-20 text-neutral-900 hover:bg-sky-200'>
            <td class='px-6 py-2 whitespace-nowrap text-center'>
              <a href='?page=genInv&id=" . $invoice["id"] . "' type='button' class='bg-sky-100 px-3 rounded-md group'>
                <i
                  class='fa-sharp fa-solid fa-download text-sky-900 text-lg group-hover:text-orange-600 transition-all duration-150'
                ></i>
              </a>
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center'>" .$invoice["emitDate"]. "</td>
            <td class='px-6 py-2 whitespace-nowrap text-center'>" . $invoice["series"] . "-" . $invoice["id"] . "</td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
              ". $clientDetails[0]["name"] ."
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
             " . $invoice["value"] . "
            </td>
          
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
            " . $invoice["totalValue"] . "
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
            " . strtoupper($invoice["currency"]) . "
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
            " . $invoice["status"] . "
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center'>
              <a href='?page=editInvoiceForm&id=". $invoice['id']  ."' type='button' class='bg-sky-100 px-3 rounded-md group'>
                <i
                  class='fa-solid fa-pen-to-square text-sky-900 text-lg group-hover:text-orange-600 transition-all duration-150'
                ></i>
              </a>
            </td>
          </tr>";
        }



        $setting = $settings -> getSettings();
        $data['furnizor'] = $setting[0]['name'];
        $data['cuiFurnizor'] = $setting[0]['cui']; 
        $data['jFurnizor'] = $setting[0]['j'];
        $data['adresaFurnizor'] = $setting[0]['location'];
        $data['orasFurnizor'] = $setting[0]['county'];
        $data['ibanFurnizor'] = $setting[0]['iban'];
        $data['bancaFurnizor']= $setting[0]['bank'];
        


        $listaClienti = $client->showClients();


        $data["stringClienti"] = "";
       foreach($listaClienti as $client){
        $data["stringClienti"] .= $client["name"] . ",";
       }

        $content["content"] = $this->render(APP_PATH.VIEWS.'invoicespage.html', $data);
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$content);
    }



}


 