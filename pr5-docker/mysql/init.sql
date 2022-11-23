CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
SET NAMES utf8;

CREATE TABLE IF NOT EXISTS hero
(
    id          int NOT NULL AUTO_INCREMENT,
    name        varchar(191),
    info        varchar(200),
    dmg         int,
    primary key (id)
);

CREATE TABLE IF NOT EXISTS mus
(
    id          int NOT NULL AUTO_INCREMENT,
    name        varchar(191),
    autors      varchar(500),
    time        int,
    primary key (id)
);

CREATE TABLE IF NOT EXISTS auth (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY(ID)
);


INSERT INTO auth (login, password)
VALUES ('login', '{SHA}QL0AFWMIX8NRZTKeof9cXsvbvu8=');

INSERT INTO hero (name, info, dmg)
VALUES
    ('Horn', 'жосткий гуард', 100),
    ('РУДГЕ', 'самая лучшая девочка DOTA2', 1000000),
    ('IO', 'сап, которого зовут десяточка', 0),
    ('Олег', 'гг этой новэллы', 1),
    ('Подпивас', 'просто подпивас', 666);

INSERT INTO mus (name, autors, time)
VALUES
    ('Яма','Убей меня, эйс', 301),
    ('Ультранасилие','Влажность', 142),
    ('Cigaro','System of down', 211);
