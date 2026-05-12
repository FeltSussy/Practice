DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS customers;

CREATE TABLE customers (
    customer_id INTEGER PRIMARY KEY AUTOINCREMENT,
    customer_name VARCHAR(100) NOT NULL
);

CREATE TABLE orders (
    order_id INTEGER PRIMARY KEY AUTOINCREMENT,
    customer_id INTEGER REFERENCES customers(customer_id),
    order_date DATE NOT NULL,
    total_amount NUMERIC NOT NULL
);

INSERT INTO customers (customer_name) VALUES
('John Smith'),
('Emma Johnson'),
('Michael Brown'),
('Olivia Davis'),
('William Wilson'),
('Sophia Taylor'),
('James Anderson'),
('Isabella Thomas'),
('Robert Jackson'),
('Emily White');

INSERT INTO orders (customer_id, order_date, total_amount) VALUES
(1, '2023-05-15', 150),
(2, '2023-05-20', 230),
(3, '2023-06-05', 75),
(4, '2023-06-12', 310),
(5, '2023-06-28', 180),
(1, '2023-07-10', 210),
(6, '2023-07-22', 95),
(7, '2023-08-05', 350),
(8, '2023-08-18', 120),
(9, '2023-09-01', 280),
(10, '2023-09-15', 165),
(2, '2023-09-30', 220),
(2, '2023-10-12', 190),
(4, '2023-10-25', 330),
(5, '2023-11-08', 140),
(4, '2023-11-20', 260),
(4, '2023-12-02', 110),
(8, '2023-12-15', 320),
(8, '2023-12-28', 175),
(10, '2024-01-10', 290),
(1, '2024-01-22', 130),
(1, '2024-02-05', 240),
(3, '2024-02-18', 800),
(3, '2024-03-01', 340),
(3, '2024-03-15', 160),
(3, '2024-03-28', 270),
(3, '2024-04-10', 100),
(7, '2024-04-23', 360),
(7, '2024-05-05', 135),
(10, '2024-05-18', 250),
(10, '2024-01-15', 100);