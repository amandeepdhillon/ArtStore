<?php
/*
  Table Data Gateway for the Genre table.
 */
class GenreTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Genre";
   } 
   protected function getTableName()
   {
      return "Genres";
   }
   protected function getOrderFields() 
   {
      return 'EraID, GenreName';
   }
  
   protected function getPrimaryKeyName() {
      return "GenreID";
   }
   
   public function findGenresByPaintingID($paintingID){
      $sql = $this->getSelectStatement()." JOIN PaintingGenres USING(GenreID) WHERE PaintingID=?";
      
      $result = $this->dbAdapter->fetchAsArray($sql, Array($paintingID));    
   
      return $this->convertRecordsToObjects($result); 
   }
}

?>