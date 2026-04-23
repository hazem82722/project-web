<?php
include "db.php";

if (isset($_POST['buy_submit'])) {

    $car_id = $_POST['car_id'];
    $name = $_POST['full_name'];

    $conn->query("INSERT INTO orders (car_id, full_name) VALUES ('$car_id', '$name')");

    echo "تم الشراء";
}
?>
