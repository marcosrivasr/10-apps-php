CREATE TABLE comments (
    id int NOT NULL AUTO_INCREMENT,
    uuid varchar(255) NOT NULL UNIQUE,
    username varchar(255) NOT NULL,
    text varchar(255) NOT NULL,
    url varchar(255) NOT NULL,
    date varchar(100) NOT NULL,
    PRIMARY KEY (id)
);