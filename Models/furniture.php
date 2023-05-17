<?php
include_once("product.php");
class Furniture extends Product
{
    protected $Dimen;

    public function __construct($id, $sku, $name, $price, $type, $Dimen)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->id = $id;

        $this->Dimen = $Dimen;
    }

    public function getAttribute()
    {
        return $this->Dimen;
    }

    public function setAttribute($Dimen)
    {
        $this->Dimen = $Dimen;
    }

}

?>