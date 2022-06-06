CREATE TABLE categories (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE expenses (
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    category_id int NOT NULL,
    expense float(5,2) NOT NUll,
    date date NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
