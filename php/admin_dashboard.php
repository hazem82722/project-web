<?php
include "db.php";

// =======================
// إضافة سيارة
// =======================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_car'])) {
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $price = $_POST["price"];
    $mileage = $_POST["mileage"];

    $sql = "INSERT INTO project_db (Brand, Model, Year, Price, mileage)
            VALUES ('$brand', '$model', '$year', '$price', '$mileage')";
    $conn->query($sql);

    header("Location: admin_dashboard.php");
    exit();
}

// =======================
// حذف سيارة
// =======================
if (isset($_GET['delete_car'])) {
    $id = $_GET['delete_car'];
    $conn->query("DELETE FROM project_db WHERE ID = $id");

    header("Location: admin_dashboard.php");
    exit();
}

// =======================
// تحديث طلب
// =======================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_order'])) {
    $id = $_POST["id"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $paid_price = $_POST["paid_price"];

    $sql = "UPDATE orders 
            SET full_name='$full_name',
                email='$email',
                phone='$phone',
                address='$address',
                paid_price='$paid_price'
            WHERE id=$id";

    $conn->query($sql);

    header("Location: admin_dashboard.php");
    exit();
}

// =======================
// حذف طلب
// =======================
if (isset($_GET['delete_order'])) {
    $id = $_GET['delete_order'];
    $conn->query("DELETE FROM orders WHERE id = $id");

    header("Location: admin_dashboard.php");
    exit();
}

// =======================
// جلب طلب للتعديل
// =======================
$editOrder = null;

if (isset($_GET['edit_order'])) {
    $id = $_GET['edit_order'];
    $resultEdit = $conn->query("SELECT * FROM orders WHERE id = $id");
    if ($resultEdit && $resultEdit->num_rows > 0) {
        $editOrder = $resultEdit->fetch_assoc();
    }
}

// =======================
// عرض السيارات
// =======================
$cars_result = $conn->query("SELECT * FROM project_db");

// =======================
// عرض الطلبات
// =======================
$orders_result = $conn->query("SELECT * FROM orders");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Admin Dashboard</h1>

<p>
    <a href="databaseCars.php">View Customer Page</a>
</p>

<hr>

<h2>All Cars</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Price</th>
        <th>Mileage</th>
        <th>Action</th>
    </tr>

    <!-- صف الإضافة -->
    <tr>
        <form method="POST">
            <td>New</td>
            <td><input type="text" name="brand" required></td>
            <td><input type="text" name="model" required></td>
            <td><input type="number" name="year" required></td>
            <td><input type="number" name="price" required></td>
            <td><input type="number" name="mileage" required></td>
            <td>
                <button type="submit" name="add_car">Add</button>
            </td>
        </form>
    </tr>

    <?php
    if ($cars_result->num_rows > 0) {
        while($car = $cars_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($car['ID']) . "</td>
                    <td>" . htmlspecialchars($car['Brand']) . "</td>
                    <td>" . htmlspecialchars($car['Model']) . "</td>
                    <td>" . htmlspecialchars($car['Year']) . "</td>
                    <td>" . htmlspecialchars($car['Price']) . " SAR</td>
                    <td>" . htmlspecialchars($car['mileage']) . "</td>
                    <td>
                        <a href='admin_dashboard.php?delete_car={$car['ID']}' onclick=\"return confirm('Delete this car?')\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No cars found</td></tr>";
    }
    ?>
</table>

<hr>

<h2>Customer Orders</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Order ID</th>
        <th>Car ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Paid Price</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    <?php
    if ($orders_result->num_rows > 0) {
        while($order = $orders_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($order['id']) . "</td>
                    <td>" . htmlspecialchars($order['car_id']) . "</td>
                    <td>" . htmlspecialchars($order['full_name']) . "</td>
                    <td>" . htmlspecialchars($order['email']) . "</td>
                    <td>" . htmlspecialchars($order['phone']) . "</td>
                    <td>" . htmlspecialchars($order['address']) . "</td>
                    <td>" . htmlspecialchars($order['paid_price']) . " SAR</td>
                    <td>" . htmlspecialchars($order['created_at']) . "</td>
                    <td>
                        <a href='admin_dashboard.php?edit_order={$order['id']}'>Edit</a> |
                        <a href='admin_dashboard.php?delete_order={$order['id']}' onclick=\"return confirm('Delete this order?')\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No orders found</td></tr>";
    }
    ?>
</table>

<?php if ($editOrder): ?>
<hr>

<h2>Edit Order</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $editOrder['id']; ?>">

    <label>Name:</label><br>
    <input type="text" name="full_name" value="<?php echo htmlspecialchars($editOrder['full_name']); ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($editOrder['email']); ?>" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?php echo htmlspecialchars($editOrder['phone']); ?>" required><br><br>

    <label>Address:</label><br>
    <textarea name="address" required><?php echo htmlspecialchars($editOrder['address']); ?></textarea><br><br>

    <label>Paid Price:</label><br>
    <input type="number" name="paid_price" value="<?php echo htmlspecialchars($editOrder['paid_price']); ?>" required><br><br>

    <button type="submit" name="update_order">Update</button>
</form>

<?php endif; ?>

</body>
</html>