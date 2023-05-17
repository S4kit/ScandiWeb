<?php
include_once("product.php");

class DVD extends Product
{
    protected $size;

    public function __construct($id, $sku, $name, $price, $type, $size)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->id = $id;

        $this->size = $size;
    }

    public function getAttribute()
    {
        return $this->size;
    }

    public function setAttribute($size)
    {
        $this->size = $size;
    }


}

?>