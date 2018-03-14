<?php

class UsersGateway extends Adapter {
    public function __construct($connect) {
    parent::__construct($connect);
    }
     
    protected function getSelectStatement(){
        return "SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM Users ";
    }
     
    protected function getOrderFields() {
        return 'LastName, FirstName' ;
    }
    
    protected function getPrimaryKeyName() {
        return "UserID";
    }
}

?>