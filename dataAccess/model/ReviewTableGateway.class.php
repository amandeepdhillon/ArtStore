<?php
/*
  Table Data Gateway for the Reivew table.
 */
class ReviewTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Review";
   } 
   protected function getTableName()
   {
      return "Reviews";
   }
   protected function getOrderFields() 
   {
      return 'ReviewDate';
   }
  
   protected function getPrimaryKeyName() {
      return "RatingID";
   }
}

?>