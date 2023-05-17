<?php
include_once("product.php");
class Book extends Product
{
    protected $Weight;

    public function __construct($id, $sku, $name, $price, $type, $Weight)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->id = $id;
        $this->Weight = $Weight;
    }

    public function getAttribute()
    {
        return $this->Weight;
    }

    public function setAttribute($Weight)
    {
        $this->Weight = $Weight;
    }


}

?>