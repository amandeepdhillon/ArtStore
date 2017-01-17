<?php
/*
  Table Data Gateway for the Genre table.
 */
class ShapeTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Shape";
   } 
   protected function getTableName()
   {
      return "Shapes";
   }
   protected function getOrderFields() 
   {
      return 'ShapeName';
   }
  
   protected function getPrimaryKeyName() {
      return "ShapeID";
   }
}

?>