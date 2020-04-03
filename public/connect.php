<?php
define("DSN", "mysql:host=localhost;dbname=checkpoint1");
define("USER", "root");
define("PASS", "070284**");

$pdo = new PDO(DSN, USER, PASS);

/**
 * mysql -u root -p
 * CREATE DATABASE checkpoint1;
 * USE checkpoint1;
 * CREATE TABLE bribe (id INT AUTO_INCREMENT NOT NULL PRIMARY KEY, name VARCHAR(50), payment INT(20));
 * INSERT INTO bribe (name, payment) VALUES ('Al Capone', 145621);
 * INSERT INTO bribe (name, payment) VALUES ('Joseph Civello', 100);
 * INSERT INTO bribe (name, payment) VALUES ('Vincenzo Cotroni', 56321);
 * INSERT INTO bribe (name, payment) VALUES ('Vito Genovese', 89621);
 * INSERT INTO bribe (name, payment) VALUES ('Antonio Geraci', 5175621);
 * SELECT name, payment FROM bribe ORDER BY name ASC;
 */