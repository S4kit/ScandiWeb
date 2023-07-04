<?php

class Product
{
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $attribute;

    public function __construct($sku, $name, $price, $type, $attribute)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->attribute = $attribute;
    }

    public function getID()
    {
        return $this->id;
    }
    public function getAttribute()
    {
        return $this->attribute;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function getType()
    {
        return $this->type;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }



}




?>