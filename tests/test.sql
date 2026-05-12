SELECT
    c.customer_name AS customer,
    COUNT(order_id) AS orders_count
FROM customers AS c
LEFT JOIN orders AS o
	ON o.customer_id = c.customer_id
GROUP BY customer;