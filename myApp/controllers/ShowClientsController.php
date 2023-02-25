<?php

class ShowClientsController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

      session_start();

      if(isset($_SESSION['userName'])){
        $content['userName'] = $_SESSION['userName'];
    } else {
      header("Location: ?page=login");
    }
    

        $client = new ClientsModel;

        $result = $client->showClients();


        $data["clientsTable"] = '';

        foreach ($result as $client) {
            $data["clientsTable"] .= "
           
            <tr class='bg-white even:bg-sky-50 border-b mx-20 text-neutral-900 hover:bg-sky-200'>
              <td class='px-6 py-2 whitespace-nowrap'>" . $client["name"] . "</td>
              <td class='px-6 py-2 whitespace-nowrap'>" . $client["CUI"] . "</td>
              <td class='px-6 py-2 whitespace-nowrap'>" . $client["J"] . "</td>
              <td class='px-6 py-2 whitespace-nowrap'>" . $client["location"] . "</td>
              <td class='px-6 py-2 whitespace-nowrap'>" . $client["contactPers"] . "</td>
              <td class='px-6 py-2 whitespace-nowrap'>" . $client["name"] . "</td>
              <td class='px-6 py-2 whitespace-nowrap'>
                <a href='?page=editClientForm&id=" . $client["id"] . " ' type='button' class='bg-sky-100 px-3 rounded-md group'>
                  <i
                    class='fa-solid fa-pen-to-square text-sky-900 text-lg group-hover:text-orange-600 transition-all duration-150'
                  ></i>
                </a>
              </td>
              <td class='px-6 py-2 whitespace-nowrap'>
                <a href='?page=delClient&id= " . $client["id"] .  "' type='button' class='bg-sky-100 px-3 rounded-md group'>
                  <i class='fa-sharp fa-solid fa-trash text-sky-900 text-lg
                  group-hover:text-orange-600 transition-all duration-150'
                </a>
              </td>
            </tr>";
        }


        $content["content"] = $this->render(APP_PATH . VIEWS . 'companiespage.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
    }
}
