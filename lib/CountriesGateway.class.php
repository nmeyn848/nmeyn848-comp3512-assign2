<?php

class CountriesGateway extends Adapter {
    public function __construct($connect) {
    parent::__construct($connect);
    }
     
    protected function getSelectStatement(){
        return "SELECT ISO, ISONumeric, CountryName, Capital, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM Countries ";
    }
     
    protected function getOrderFields() {
        return 'CountryName';
    }
    
    protected function getPrimaryKeyName() {
        return "ISO";
    }
}

?>