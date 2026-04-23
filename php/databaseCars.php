<?php
include "db.php";

if (isset($_POST['buy_submit'])) {

    $car_id = $_POST['car_id'];
    $name = $_POST['full_name'];

    $conn->query("INSERT INTO orders (car_id, full_name) VALUES ('$car_id', '$name')");

<<<<<<< HEAD
    echo "تم الشراء";
=======
    echo "Done";
>>>>>>> d9fe65461f25fab10e986dc22ec1d399feea0042
}
?>
