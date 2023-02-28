<?php

class ShowUsersController extends AppController
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
    
      
        $user = new UsersModel;

        $result = $user->showUsers();

        $data["usersTableContent"] = "";

        if ($result) {
            foreach ($result as $user) {


              //translate level
              


                $data["usersTableContent"] .= "<tr class=' hover:bg-sky-200 bg-white even:bg-sky-50 border-b mx-20 text-neutral-900 hover:bg-sky-200'>
                <td class='px-6 py-2 whitespace-nowrap text-center'>" . $user['name'] . "</td>
                <td class='px-6 py-2 whitespace-nowrap text-center'>" . $user['phone'] . "</td>
                <td class='px-6 py-2 whitespace-nowrap text-center'>" . $user['email'] . "</td>
                <td class='px-6 py-2 whitespace-nowrap text-center'>" . $user['level'] . "</td>
                <td class='px-6 py-2 whitespace-nowrap text-center'>
                  <button type='button' class='bg-sky-100 px-3 rounded-md group'>
                    <i
                      class='fa-solid fa-pen-to-square text-sky-900 text-lg group-hover:text-orange-600 transition-all duration-150'
                    ></i>
                  </button>
                </td>
                <td class='px-6 py-2 whitespace-nowrap text-center'>
                  <a href='?page=delUser&id=" .$user['id'] . "' type='button' class='bg-sky-100 px-3 rounded-md group'>
                    <i class='fa-sharp fa-solid fa-trash text-sky-900 text-lg
                    group-hover:text-orange-600 transition-all duration-150'
                  </a>
                </td>
              </tr>";
            }
        } else {
            $data["usersTableContent"] = "<tr><td>nu s-a gasit nici un user<td></tr>";
        }


        $content["content"] = $this->render(APP_PATH . VIEWS . 'userspage.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
    }
}
