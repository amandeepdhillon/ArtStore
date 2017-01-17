<?php

class Painting extends DomainObject implements JsonSerializable
{
       
    static function getFieldNames() {
            return array('PaintingID','ArtistID', 'GalleryID', 'ImageFileName', 'Title', 'ShapeID', 'MuseumLink', 'AccessionNumber', 'CopyrightText', 'Description','Excerpt', 'YearOfWork', 'Width' , 'Height', 'Medium', 'Cost', 'MSRP', 'GoogleLink', 'GoogleDescription', 'WikiLink');
        }

    public function __construct(array $data, $generateExc)
        {
            parent::__construct($data, $generateExc);
        }
        
    public function jsonSerialize(){
        $json = parent::jsonSerialize();
        
        if($this->ArtistName){
            $json['ArtistName'] = utf8_encode($this->ArtistName);
        }
        return $json;
    }
   
   // implement any setters that need input checking/validation
}



?>