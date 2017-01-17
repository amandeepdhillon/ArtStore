<?php

class TypesGlass extends DomainObject
{
       
    static function getFieldNames() {
            return array("GlassID", "Title", "Description", "Price");
    }

    public function __construct(array $data, $generateExc)
        {
            parent::__construct($data, $generateExc);
        }
   
   // implement any setters that need input checking/validation
}



?>