

<?php
/*
  Table Data Gateway for the Painting table. 
 */
class PaintingTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Painting";
   } 
   protected function getTableName()
   {
      return "Paintings";
   }
   protected function getOrderFields() 
   {
      return 'YearOfWork';
   }
   
   protected function getPrimaryKeyName() {
      return "PaintingID";
   }

/* Find all paintings within the same genre
* @returns list of objects
*/
   public function getPaintingsByGenreID($genreID){
      $sql = $this->getSelectStatement()." JOIN PaintingGenres USING(PaintingID) WHERE GenreID=? ORDER BY YearOfWork";
      
      $result = $this->dbAdapter->fetchAsArray($sql, array($genreID));    

      return $this->convertRecordsToObjects($result); 
   }

/* Find all paintings of the same subject
* @returns list of objects
*/
   public function getPaintingsBySubjectID($subjectID){
      $sql = $this->getSelectStatement()." JOIN PaintingSubjects USING(PaintingID) WHERE SubjectID=?";
      
      $result = $this->dbAdapter->fetchAsArray($sql, array($subjectID));    

      return $this->convertRecordsToObjects($result); 
   }
}
?>

