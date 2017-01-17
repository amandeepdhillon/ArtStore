<?php
/*
  Table Data Gateway for the Subject table.
 */
class SubjectTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Subject";
   } 
   protected function getTableName()
   {
      return "Subjects";
   }
   protected function getOrderFields() 
   {
      return 'SubjectName';
   }
  
   protected function getPrimaryKeyName() {
      return "SubjectID";
   }
   
    public function findSubjectsByPaintingID($paintingID) {
      $sql = $this->getSelectStatement()." JOIN PaintingSubjects USING (SubjectID) WHERE PaintingID = ?";

      $result = $this->dbAdapter->fetchAsArray($sql, Array($paintingID));    

      return $this->convertRecordsToObjects($result); 
    }
}

?>