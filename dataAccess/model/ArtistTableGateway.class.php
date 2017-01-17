

<?php 
/*
  Table Data Gateway for the Artist table. 
*/
class ArtistTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Artist";
   } 
   
   protected function getTableName()
   {
      return "Artists";
   }
   
   protected function getOrderFields() 
   {
      return 'LastName, FirstName';
   }
   
   protected function getPrimaryKeyName() 
   {
      return "ArtistID";
   }
   
   public function getArtistByPaintingID($paintingID){
      $sql = $this->getSelectStatement(). " JOIN Paintings USING(ArtistID) WHERE PaintingID=?";
      
      $result = $this->dbAdapter->fetchRow($sql, Array($paintingID));    

      return $this->convertRowToObject($result); 
   }
   
}

?>

