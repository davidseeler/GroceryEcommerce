CREATE SCHEMA IF NOT EXISTS neds_grocery;

USE neds_grocery;

CREATE TABLE IF NOT EXISTS department (
  id INT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS products (
  productID INT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  departmentID INT NOT NULL,
  imgLink VARCHAR(255) NOT NULL
);
  

CREATE TABLE IF NOT EXISTS cart (
  cartID INT NOT NULL PRIMARY KEY,
  accountID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS cartDetail (
  cartID INT NOT NULL,
  productID INT NOT NULL,
  quantity INT NOT NULL,
  PRIMARY KEY (cartID, productID)
);

CREATE TABLE IF NOT EXISTS account (
  username VARCHAR(20) NOT NULL PRIMARY KEY,
  hashed_password VARCHAR(255) NOT NULL,
  cartID INT NOT NULL,
  creditCard VARCHAR(16) NOT NULL,
  email VARCHAR(45) NOT NULL,
  phone VARCHAR(10) NOT NULL,
  firstName VARCHAR(20) NOT NULL,
  lastName VARCHAR(20) NOT NULL,
  address1 VARCHAR(50) NOT NULL,
  country VARCHAR(20) NOT NULL,
  zipcode VARCHAR(5) NOT NULL,
  city VARCHAR(20) NOT NULL,
  state VARCHAR(20) NOT NULL
);


