/*
mysql -h localhost -u root -D ses -p < C:/wamp/www/78816033/table.sql
*/

--SET FOREIGN_KEY_CHECKS = 1;


CREATE TABLE user(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    password VARCHAR(60)
    );


CREATE TABLE joblevel (
  ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  level INT,
  description VARCHAR(50)
);


CREATE TABLE employee (
  ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  position_id INT,
  fullname VARCHAR(50),
  surname VARCHAR(50),
  employed_date DATE,
  birthday DATE,
  tell VARCHAR(50),
  email VARCHAR(50),
  ACTIVE boolean NOT NULL DEFAULT 1,
  FOREIGN KEY (user_id) REFERENCES user(ID),
  FOREIGN KEY (position_id) REFERENCES joblevel(ID)
);


CREATE TABLE review (
  ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  employee_id INT,
  reviewer_id INT,
  comment VARCHAR(1000),
  comment_date DATE
);

CREATE TABLE likes (
  ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  employee_id INT,
  employee_liked_id INT,
  FOREIGN KEY (employee_id) REFERENCES employee(ID),
  FOREIGN KEY (employee_liked_id) REFERENCES employee(ID)
);
