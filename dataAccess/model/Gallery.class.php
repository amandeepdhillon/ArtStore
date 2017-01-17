<?php
/*
   Represents a single row for the Artist table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Gallery extends DomainObject
{  
   
   static function getFieldNames() {
      return array('GalleryID','GalleryName','GalleryNativeName','GalleryCity','GalleryCountry', 'Latitude','Longitude','GalleryWebSite');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
}

?>