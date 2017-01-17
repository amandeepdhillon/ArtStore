<?php

class TypesFrames extends DomainObject
{
       
    static function getFieldNames() {
            return array("FrameID", "Title", "Price", "Color", "Style");
    }

    public function __construct(array $data, $generateExc)
        {
            parent::__construct($data, $generateExc);
        }
   
   // implement any setters that need input checking/validation
}



?>