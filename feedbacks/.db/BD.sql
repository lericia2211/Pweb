create database bd;
use bd;

CREATE TABLE USUARIOS (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    USUARIO VARCHAR(255) NOT NULL,
    SENHA VARCHAR(255) NOT NULL
);


CREATE TABLE `cadastros` (
  `id` int(11) NOT NULL,
  `feedback` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `data` date DEFAULT NULL
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO USUARIOS (USUARIO, SENHA)
VALUES ('admin', MD5('senha123')); 




