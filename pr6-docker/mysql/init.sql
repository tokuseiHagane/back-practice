CREATE DATABASE IF NOT EXISTS appDB2;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB2.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB2;
SET NAMES utf8;

CREATE TABLE IF NOT EXISTS authors (
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    surname VARCHAR(30),
    age INT,
    PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS articles (
    ID INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100),
    content LONGTEXT,
    author VARCHAR(191),
    PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS auth (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY(ID)
);

INSERT INTO auth (login, password)
VALUES ('login', '{SHA}QL0AFWMIX8NRZTKeof9cXsvbvu8=');

INSERT INTO authors (name, surname, age)
VALUES
    ('Alexey', 'Nadezhin', 52),
    ('Игнатий', 'Цукергохер', 35),
    ('Василиса', 'Пантелеева', 24),
    ('Максим', 'Артамонов', 20),
    ('Варвара', 'Логинова', 44);

INSERT INTO articles (title, content, author)
VALUES
    ('Решено с 2035 года приостановить синхронизацию мировых атомных часов с астрономическим временем',
    'На Генеральной конференции по мерам и весам принято решение как минимум начиная с 2035 года приостановить периодическую синхронизацию эталонных мировых атомных часов с астрономическим временем Земли. Из-за неоднородности вращения Земли астрономические часы немного отстают от эталонных и для синхронизации точного времени начиная c 1972 года атомные часы раз в несколько лет приостанавливались на одну секунду, как только разница между эталонным и астрономическим временем достигала 0.9 секунд (последняя подобная корректировка была 8 лет назад). С 2035 года синхронизация будет прекращена и разница между мировым координированным временем (UTC) и астрономическим временем (UT1, среднее солнечное время) будет накапливаться.',
    'Opennet'),
    ('Сверхъяркая филаментная лампа',
    'Измеренная потребляемая мощность оказалась вдвое меньше обещанной, световой поток на 19% меньше, индекс цветопередачи 85, а не 90, цветовая температура 2900K, а не 2700K, но всё равно лампа интересная. У неё очень высокая эффективность — 164 лм/Вт и она очень яркая — способна заменить лампу накаливания 170 Вт.
Лампа действительно способна работать в диапазоне 185-265 вольт, у неё почти нет пульсации (при 220-230 В — меньше 1%, при минимально допустимых по ГОСТ 207 вольтах — около 2%, при ещё более низком напряжении коэффициент пульсации начинает расти и доходит до 24% при 185 В). При напряжении 190 В яркость снижается на 5%, при 185 В на 10%.',
    'Alexey Nadezhin'),
    ('Positive Hack Day 2022. Отчёт-ретроспектива',
    'Так уж получилось, что информационная служба Хабра посетила нулевой (пресс-день) день двухдневного фестиваля кибербезопасности Positive Hack Day — масштабного мероприятия, фестиваля по кибербезопасности. Оно разделено на онлайн и офлайн программы. Кроме того, в рамках фестиваля проходит интересное соревнование под названием The Standoff.
Данное действо включает стенд, имитирующий работу определённых компаний в различных сферах жизни общества: транспорт, банкинг, нефтедобывающая промышленность, гидроэлектростанции и так далее. По сути, это город с инфраструктурой. И есть две группы людей: одна — это различные белые хакеры, они всячески пытаются взломать этот стенд. И есть вторая группа людей — это специалисты по информационной безопасности. Их задача — выявить взлом или противостоять ему. В прошлый раз была задача только выявить взлом и сделать по нему отчёт. Получается, условно, команда взломщиков и команда защитников. ',
    'Игнатий Цукергохер');
