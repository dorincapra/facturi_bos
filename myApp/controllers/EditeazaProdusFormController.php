<?php

class EditeazaProdusFormController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {


        session_start();

        if($_SESSION['userName']){
            $data['userName'] = $_SESSION['userName'];
        } else {
            header("Location: ?page=home");
        }


        $data["invoiceID"] = $_GET['id'];
        $item = new ItemsModel();
        $items = $item->getItemDetailsByInvoice($data["invoiceID"]);

        $data['produse'] = '';

        foreach($items as $item){
            $data['produse'] .= "<div class='bg-sky-50 rounded-md'>
            <div class='flex flex-wrap'>
              <div class='inline-block flex flex-col items-start justify-start p-2'>
                <label for='itemName' class='italic mb-1 hidden'>Denumire:*</label
                ><textarea
                  type='text'
                  id='itemName'
                  name='product_name[]'
                  class='w-full py-0.5 px-2 text-sm placeholder:text-sm placeholder:text-neutral-400 placeholder:italic'
                  placeholder='Denumire*'
                  rows='2'
                  required
                >". $item['description'] ."</textarea>
              </div>
              <div
                class='inline-block w-full lg:w-1/4 flex flex-col items-start justify-start p-2'
              >
                <label for='itemQty' class='italic mb-1 hidden'>Cant.:*</label
                ><input
                  type='number'
                  id='itemQty'
                  name='product_qty[]'
                  value=". $item['quantity'] ."
                  class='w-full py-0.5 px-2 text-sm placeholder:text-sm placeholder:text-neutral-400 placeholder:italic'
                  placeholder='Cantitate*'
                  required
                />
              </div>
              <div
                class='inline-block w-full lg:w-1/4 flex flex-col items-start justify-start p-2'
              >
                <label for='itemPrice' class='italic mb-1 hidden'
                  >Pret unit.:*</label
                ><input
                  type='number'
                  id='itemPrice'
                  name='product_price[]'
                  value= ". $item['unitPrice'] ."
                  class='w-full py-0.5 px-2 text-sm placeholder:text-sm placeholder:text-neutral-400 placeholder:italic'
                  placeholder='Pret unitate*'
                  required
                />
              </div>
              <div
                class='inline-block w-full lg:w-1/4 flex flex-col items-start justify-start p-2'
              >
                <label for='itemTva' class='italic mb-1 hidden'>T.V.A.:*</label
                ><input
                  type='number'
                  id='itemTva'
                  name='product_vat[]'
                  value= ". $item['vat']/$item['unitPrice']/$item['quantity'] *100 ."
                  class='w-full py-0.5 px-2 text-sm placeholder:text-sm placeholder:text-neutral-400 placeholder:italic'
                  placeholder='T.V.A.*'
                  required
                />
              </div>
              <div
                class='inline-block w-full lg:w-3/4 flex items-start justify-start p-2'
              >
    
                <button
                  type='button'
                  class='remove_item_btn py-0.5 px-2 text-sm border border-red-900 rounded text-neutral-900 hover:text-neutral-50 hover:bg-red-900 transition-all duration-150'
                >
                  Sterge produs
                </button>
              </div>
            </div>
          </div>";
        }


        

       $content["content"] = $this->render(APP_PATH.VIEWS.'editeazaProdusForm.html',$data);
       echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$content);

       
}

}
