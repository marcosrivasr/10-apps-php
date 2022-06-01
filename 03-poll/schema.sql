CREATE TABLE polls (
    id int NOT NULL AUTO_INCREMENT,
    uuid varchar(255) NOT NULL UNIQUE,
    title varchar(255) NOT NULL,
    end_date varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE options (
    id int NOT NULL AUTO_INCREMENT,
    poll_id int NOT NULL,
    title varchar(255) NOT NULL,
    votes int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (poll_id) REFERENCES polls(id)
);
