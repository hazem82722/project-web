<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy_submit'])) {

    $car_id = $_POST["car_id"];
    $car_name = $_POST["car_name"];
    $car_year = $_POST["car_year"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $paid_price = $_POST["paid_price"];

    $sql = "INSERT INTO orders (car_id, car_name, car_year, full_name, email, phone, address, paid_price)
            VALUES ('$car_id', '$car_name', '$car_year', '$full_name', '$email', '$phone', '$address', '$paid_price')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <!DOCTYPE html>
        <html lang='ar'>
        <head>
            <meta charset='UTF-8'>
            <title>تم الشراء</title>
            <style>
                body {
                    font-family: Arial;
                    background: #f4f6f9;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .box {
                    background: white;
                    padding: 30px;
                    border-radius: 12px;
                    text-align: center;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                h2 { color: green; }
                a {
                    display: inline-block;
                    margin-top: 15px;
                    padding: 10px 20px;
                    background: blue;
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                }
            </style>
        </head>
        <body>
            <div class='box'>
                <h2>✅ تم الشراء بنجاح</h2>
                <p>تم استلام طلبك</p>
                <a href='../Car.html'>رجوع</a>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>