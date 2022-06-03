CREATE TABLE stock (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    ticker varchar(255) NOT NULL,
    performanceId varchar(255) NOT NULL,
    PRIMARY KEY (id)
);