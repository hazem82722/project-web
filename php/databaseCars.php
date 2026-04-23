<?php
include "db.php";

if (isset($_POST['buy_submit'])) {

    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $car_year = $_POST['car_year'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $paid_price = $_POST['paid_price'];

    $sql = "INSERT INTO orders 
    (car_id, car_name, car_year, full_name, email, phone, address, paid_price)
    VALUES 
    ('$car_id', '$car_name', '$car_year', '$full_name', '$email', '$phone', '$address', '$paid_price')";

    if ($conn->query($sql)) {
        echo "Done";
    } else {
        echo "خطأ: " . $conn->error;
    }
}
?>
