<?php

namespace App\Solution;

function getOrderCount($period)
{
    $conn = new \PDO('sqlite:memory');
    $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    $sql = file_get_contents("sql.sql");
    $conn->exec($sql);

    // BEGIN (write your solution here)
    $month = sprintf('%02d', $period);

    $sql1 = "
    SELECT
        c.customer_name AS customer,
        SUM(total_amount) AS amount
    FROM customers AS c
    LEFT JOIN orders AS o
        ON o.customer_id = c.customer_id
    WHERE strftime('%m', o.order_date) = :month
    GROUP BY customer;
    ";
    $stmt = $conn->prepare($sql1);
    $stmt->bindParam(':month', $month);
    $stmt->execute();

    $result = $stmt->fetchAll();

    $final = [];

    foreach ($result as $customer) {
        $final[] = sprintf("Покупатель %s совершил покупок на сумму %d", $customer['customer'], $customer['amount']);
    }
    return implode("\n", $final);
    // END
}

getOrderCount(1);