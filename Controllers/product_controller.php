<?php
include '../database/dbConnect.php';
include '../Models/product.php';

class ProductController
{
    private $db;

    function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function saveProduct(Product $product)
    {
        $sku = $product->getSKU();
        $check = $this->checkDouble($sku);

        if ($check == true) {
            $name = $product->getName();
            $price = $product->getPrice();
            $type = $product->getType();
            $attribute = $product->getAttribute();

            $query = "INSERT INTO products (sku, name, price, type, attribute) VALUES ('$sku', '$name', '$price', '$type', '$attribute')";
            $result = $this->db->executeQuery($query);
        }

        return true;
    }

    public function Delete($id)
    {
        $id = implode(",", $id);

        if (empty($id)) {
            return false;
        } else {
            $query = "DELETE FROM products WHERE id IN ($id)";
            $this->db->executeQuery($query);

            return true;
        }
    }

    public function ShowAll()
    {
        $query = "SELECT * FROM products";
        $result = $this->db->executeQuery($query);

        $products = array();
        while ($row = $result->fetch_assoc()) {
            // Add each row to the products array
            $products[] = $row;
        }

        // Convert the products array to JSON
        $productsJson = json_encode($products);

        return $productsJson;
    }

    public function checkDouble($unique)
    {
        $sql = "SELECT sku FROM products WHERE sku = '$unique'";
        $result = $this->db->executeQuery($sql);

        if (mysqli_num_rows($result) < 1) {
            return true;
        } else {
            return false;
        }
    }
}

?>