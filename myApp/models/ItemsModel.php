<?php

class ItemsModel extends DBModel
{
    protected $description;
    protected $value;
    

    public function __construct($description='', $value=''){
        $this->description = $description;
        $this->value = $value;
        
    }


    public function addItem($description, $invoiceID, $unitPrice, $vat, $quantity){
        $q="INSERT INTO `items`(`description`,`invoiceID`, `unitPrice`, `vat`, `quantity`) VALUES (?,?,?,?,?);";
        $myPrep = $this->db()-> prepare($q);
        $myPrep->bind_param("siiii", $description, $invoiceID, $unitPrice, $vat, $quantity);
        return $myPrep->execute();
    }

    public function showItems(){
        //show all items
    }

    public function getItemDetails($id){
        // geet item details by id
    }

    public function getItemDetailsByInvoice($invoiceID){
        $q = "SELECT * FROM `items` WHERE `invoiceID` = $invoiceID ;";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function addItemTest($result){
        foreach($result as $key => $value){
            $sql = 'INSERT INTO `items` (name, price, quantity) VALUES (:name, :price, :qty)';
            $stmt = $this->db()->prepare($sql);
            $stmt->execute([
                'name' => $value,
                'price' => $_POST['product_price'][$key],
                'qty'=> $_POST['product_qty'][$key]
            ]);
        }
    }
   

}