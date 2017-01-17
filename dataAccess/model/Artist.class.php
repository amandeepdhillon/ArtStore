<?php
/*
   Represents a single row for the Artist table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Artist extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ArtistID','FirstName','LastName','Nationality','YearOfBirth', 'YearOfDeath','Details','ArtistLink', 'CONCAT(COALESCE(FirstName, " "), " ", COALESCE(LastName, "")) as ArtistName');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
   
   // *************************************************************************************
   // Can be removed?  Use ArtistName field instead.  
   // Will need to be kept around if we need a comma delimited version of the artist's name
   public function getFullName($commaDelimited)
   {
      if ($commaDelimited)
         return $this->LastName . ', ' . $this->FirstName;
      else
         return $this->FirstName . ' ' . $this->LastName;
   }
}

?>