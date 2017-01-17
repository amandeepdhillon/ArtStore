<?php
/*
  Table Data Gateway for the Matts table. 
 */
class TypesMattTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TypesMatt";
   } 
   protected function getTableName()
   {
      return "TypesMatt";
   }
   protected function getOrderFields() 
   {
      return 'Title';
   }
   
   protected function getPrimaryKeyName() {
      return "MattID";
   }
}

?>

