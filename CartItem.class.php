<?php 
class CartItem implements Serializable {
    private $paintingID;
    private $quantity;
    private $frameID;
    private $glassID;
    private $mattID;
    
    public function __construct($paintingID) {
        $this->paintingID = $paintingID;
        $this->quantity = 1;
        $this->frameID = 18;
        $this->glassID = 5;
        $this->mattID = 35;
    }
    
    public function serialize () {
        return $this->paintingID.",".$this->quantity.",".$this->frameID.",".$this->glassID.",".$this->mattID;
    }
    
    public function unserialize ($serialized) {
        $fields = explode(',', $serialized);
        $this->paintingID = $fields[0];
        $this->quantity = $fields[1];
        $this->frameID = $fields[2];
        $this->glassID = $fields[3];
        $this->mattID = $fields[4];
    }
    
    public function setQuantity($quantity) {
        if ($quantity >= 0) {
            $this->quantity = $quantity;
        }
        else {
            $quantity = 0;
        }
    }
    
    public function __set($property, $value)
    {
      if (property_exists($this, $property)) {
        $this->$property = $value;
      }
    }
    
    public function __get($property)
    {
      if (property_exists($this, $property)) {
        return $this->$property;
      }
    }
}

?>