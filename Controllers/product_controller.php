<?php
include '../database/dbConnect.php';
include '../Models/dvd.php';
include '../Models/book.php';
include '../Models/furniture.php';



class ProductController
{
    protected $con;
    function __construct()
    {
        $host = "localhost";
        $user = "root";
        $password = "root";
        $dbname = "scandiweb";
        $this->con = mysqli_connect($host, $user, $password, $dbname);
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    public function saveProduct(Product $product, $Attribute)
    {
        $sku = $product->getSKU();
        $name = $product->getName();
        $price = $product->getPrice();
        $type = $product->getType();
        $check = $this->checkDouble($sku);
        if ($check == true) {
            $query = "INSERT INTO products (sku, name, price, type) VALUES ('$sku', '$name', '$price', '$type')";
            $result = mysqli_query($this->con, $query);

            if (!$result) {
                http_response_code(404);
                die(mysqli_error($this->con));
            }
            $last_id = $this->con->insert_id;
            echo $last_id;
            switch ($type) {
                case 'DVD':
                    $query = "INSERT INTO product_details (product_id,size) VALUES ('$last_id', '$Attribute')";
                    break;
                case 'Furniture':
                    $query = "INSERT INTO product_details (product_id,dimension) VALUES ('$last_id', '$Attribute')";
                    break;
                case 'Book':
                    $query = "INSERT INTO product_details (product_id,weight) VALUES ('$last_id', '$Attribute')";
                    break;
            }
            $result = mysqli_query($this->con, $query);

            if (!$result) {
                http_response_code(404);
                die(mysqli_error($this->con));
            }
        }

        return true;


    }

    public function Delete($id)
    {

        $id = implode(",", $id);
        if (empty($id)) {
            return false;
        } else {
            $query = "DELETE FROM product_details WHERE product_id IN ($id);";
            $result = mysqli_query($this->con, $query);
            if (!$result) {
                http_response_code(404);
                die(mysqli_error($this->con));
            }
            $query = "DELETE FROM products WHERE id IN ($id);";
            $result = mysqli_query($this->con, $query);
            if (!$result) {
                http_response_code(404);
                die(mysqli_error($this->con));
            }
            return true;
        }
    }
    public function ShowAll()
    {
        $query = "SELECT * FROM products INNER JOIN product_details ON products.id=product_details.product_id ";
        $result = mysqli_query($this->con, $query);

        if (!$result) {
            http_response_code(404);
            die(mysqli_error($this->con));
        }
        $products = array();
        while ($row = $result->fetch_assoc()) {
            switch ($row['type']) {
                case 'DVD':

                    $product = new DVD($row['product_id'], $row['sku'], $row['name'], $row['price'], $row['type'], $row['size']);
                    break;
                case 'Furniture':
                    $product = new Furniture($row['product_id'], $row['sku'], $row['name'], $row['price'], $row['type'], $row['dimension']);
                    break;
                case 'Book':
                    $product = new Book($row['product_id'], $row['sku'], $row['name'], $row['price'], $row['type'], $row['weight']);
                    break;
            }
            array_push($products, $product);
        }
        $productsJson = [];

        foreach ($products as $product) {
            $productData = [
                'id' => $product->getID(),
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'type' => $product->getType()
            ];

            // Check the product type and include the relevant property
            if ($product instanceof DVD) {
                $productData['size'] = $product->getAttribute();
            } elseif ($product instanceof Furniture) {
                $productData['dimension'] = $product->getAttribute();
            } elseif ($product instanceof Book) {
                $productData['weight'] = $product->getAttribute();
            }

            $productsJson[] = $productData;
        }


        return $productsJson;

    }

    public function checkDouble($unique)
    {
        $sql = "SELECT sku from products where sku='" . $unique . "'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            http_response_code(404);
            die(mysqli_error($this->con));
        }

        if (mysqli_num_rows($result) < 1) {
            return true;
        } else {
            return false;
        }
    }

}
?>