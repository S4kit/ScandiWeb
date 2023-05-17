CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sku VARCHAR(50),
  name VARCHAR(255),
  price FLOAT(30),
  type ENUM('DVD', 'Furniture', 'Book')
);


CREATE TABLE product_details (
  id INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT,
  size INT,
  weight DECIMAL(10, 2),
  dimension VARCHAR(30),
  FOREIGN KEY (product_id) REFERENCES products(id)
);



