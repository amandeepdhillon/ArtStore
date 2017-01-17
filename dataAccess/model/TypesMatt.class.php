<?php

class TypesMatt extends DomainObject
{
       
    static function getFieldNames() {
            return array("MattID", "Title", "ColorCode");
    }

    public function __construct(array $data, $generateExc)
        {
            parent::__construct($data, $generateExc);
        }
   
   // implement any setters that need input checking/validation
}



?>