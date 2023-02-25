<?php

class ClientsModel extends DBModel
{
    protected $name;
    protected $cui;
    protected $j;

    public function __construct($name='', $cui='', $j=''){
        $this->name = $name;
        $this->cui = $cui;
        $this->j = $j;
    }


    public function addClient($name, $cui, $j, $contactPers, $phone, $email, $location, $iban){
        $q = "INSERT INTO `clients`(`name`, `CUI`, `J`, `contactPers`, `phone`, `email`, `location`, `iban`) VALUES (?,?,?,?,?,?,?,?)";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("ssssssss", $name, $cui, $j, $contactPers, $phone, $email, $location, $iban);
        return $myPrep->execute();
    }

    public function showClients(){
        $q = "SELECT * FROM `clients`";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getClientDetails($id){
        $q = "SELECT * FROM `clients` WHERE `id` = $id;";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delClient($id){
        $q = "DELETE FROM `clients` WHERE `id` = $id";
		$result = $this->db()->query($q);
        if($result) return true;
        else return false;
    }

    public function lastClientID(){
        $q = "SELECT `id` FROM `clients` ORDER BY `id` DESC LIMIT 1";
        $result = $this->db()->query($q);
        return $result->fetch_all();
    }

}