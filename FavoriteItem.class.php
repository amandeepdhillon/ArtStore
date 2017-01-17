<?php
class FavoriteItem
{
    
    private $artist;
    private $painting; //two array contains id of painting and artist
    
    public function __construct()
    {
        $this->artist = array();
         $this->painting = array();
    }
    
    public function getArtist()
    {
        return $this->artist;
    }
    
    public function getPainting()
    {
        return $this->painting;
    }
    
    public function addPainting($id)
    {
        if(array_search($id, $this->painting) === false)
        array_push($this->painting, $id);
    }
    
    public function addArtist($id)
    {
         if(array_search($id, $this->artist) === false)
        array_push($this->artist, $id);
    }
    
    public function removePainting($id)
    {
        unset($this->painting[array_search($id, $this->painting)]);
    }
    
    public function removeArtist($id)
    {
        unset($this->artist[array_search($id, $this->artist)]);
    }
    
    public function emptyArtist()
    {
        unset($this->artist);
        $this->artist = array(); //make another empty array
    }
    
    public function emptyPainting()
    {
        unset($this->painting);
        $this->painting = array();
    }
}

?>