CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sku VARCHAR(50),
  name VARCHAR(255),
  price FLOAT(30),
  type ENUM('DVD', 'Furniture', 'Book'),
  attribute VARCHAR(50)
);



