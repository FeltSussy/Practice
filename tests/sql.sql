CREATE TABLE accounts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    balance NUMERIC
);

INSERT INTO accounts VALUES
(1, 5, 150),
(2, 7, 1000),
(3, 12, 0),
(4, 1, 200),
(5, 87, 1500),
(6, 3, 300),
(7, 98, 3000),
(8, 112, 1),
(10, 23, 50),
(15, 9, 800);