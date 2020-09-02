DROP DATABASE IF EXISTS employeeManagement;
CREATE DATABASE employeeManagement;
USE employeeManagement;

CREATE TABLE employees (
    id INT(11),
    redirect VARCHAR(5),
    avatar VARCHAR(255),
    name VARCHAR(25),
    lastName VARCHAR(40),
    email VARCHAR(60),
    gender VARCHAR(6),
    city VARCHAR(40),
    streetAddress VARCHAR(40),
    state VARCHAR(25),
    age INT(3),
    postalCode INT(8),
    phoneNumber INT(9),
    PRIMARY KEY(id)
);

CREATE TABLE users (
    userId INT(11),
    name VARCHAR(25),
    password VARCHAR(100),
    email VARCHAR(60),
    PRIMARY KEY(userId)
);

INSERT INTO employees
    (id, redirect, avatar, name, lastName, email, gender, city, streetAddress, state, age, postalCode, phoneNumber) values
    (1, 'true', 'https:\/\/uifaces.co\/our-content\/donated\/5N18dOsU.jpg', 'Rack', 'Leilax', 'jackon@network.com', 'man', 'San Jone', '126', 'CA', 24, 394221, 738362764),
    (2, 'true', 'https:\/\/i.imgur.com\/oC8EjRE.jpg', 'Joanna', 'Doe', 'jhondoe@foo.com', 'woman', 'New York', '89', 'WA', 36, 09889, 128364564),
    (3, 'true', 'https:\/\/i.imgur.com\/kcPMLNS.jpg', 'Sheila', 'Millshake', 'mills@leila.com', 'woman', 'San Diego', '55', 'CA', 29, 098765, 998363246),
    (4, 'true', 'https:\/\/images.generated.photos\/AxsZ-fY9aewY9U0TjnqC64gnbPZ7hLReHgVonw2PNR8\/rs:fit:512:512\/Z3M6Ly9nZW5lcmF0\/ZWQtcGhvdG9zL3Yy\/XzA2NzUxMTkuanBn.jpg', 'Ricarda', 'Desmond', 'dismond@foo.com', 'woman', 'Salt lake city', '90', 'UT', 30, 457320, 908769876),
    (5, 'true', 'https:\/\/randomuser.me\/api\/portraits\/women\/76.jpg', 'Susan', 'Smith', 'susanmith@baz.com', 'woman', 'Louisville', '43', 'KNT', 28, 445321, 224355488);

INSERT INTO users
    (userId, name, password, email) values
    (1, 'admin', '$2y$10$nuh1LEwFt7Q2/wz9/CmTJO91stTBS4cRjiJYBY3sVCARnllI.wzBC', 'admin@assemblerschool.com');