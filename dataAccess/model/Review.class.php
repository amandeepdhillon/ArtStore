<?php
/*
   Represents a single row for the Subjects table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Review extends DomainObject
{  
   
   static function getFieldNames() {
      return array('RatingID','PaintingID', 'ReviewDate', 'Rating', 'Comment');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>