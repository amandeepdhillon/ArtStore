

<?php
/*
  Table Data Gateway for the Artist table. 
 */
class GalleryTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Gallery";
   } 
   protected function getTableName()
   {
      return "Galleries";
   }
   protected function getOrderFields() 
   {
      return 'GalleryName';
   }
   
   protected function getPrimaryKeyName() {
      return "GalleryID";
   }
   
}

?>

