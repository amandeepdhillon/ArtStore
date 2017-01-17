<?php
/*
  Table Data Gateway for the Frames table. 
 */
class TypesFramesTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TypesFrames";
   } 
   protected function getTableName()
   {
      return "TypesFrames";
   }
   protected function getOrderFields() 
   {
      return 'Title';
   }
   
   protected function getPrimaryKeyName() {
      return "FrameID";
   }
}

?>