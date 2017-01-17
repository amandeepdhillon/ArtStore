<?php
/*
  Table Data Gateway for the Painting table. 
 */
class TypesGlassTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TypesGlass";
   } 
   protected function getTableName()
   {
      return "TypesGlass";
   }
   protected function getOrderFields() 
   {
      return 'Title';
   }
   
   protected function getPrimaryKeyName() {
      return "GlassID";
   }
}

?>

