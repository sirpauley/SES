/*
terminal command for running this script
mysql -h localhost -u root -D ses -p < table.sql
*/

CREATE TABLE user(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user VARCHAR(50),
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
  fullname VARCHAR(50),
  surname VARCHAR(50),
  position_id INT,
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
