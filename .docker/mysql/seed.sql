CREATE TABLE app.products
(
    id    int NOT NULL AUTO_INCREMENT,
    name  varchar(100) DEFAULT NULL,
    price double(6, 2) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO app.products (id, name, price) VALUES
    (1, 'The Elder Scrolls V: Skyrim', 76.73),
    (2, 'Path of Exile', null);
