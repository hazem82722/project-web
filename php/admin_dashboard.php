<?php
/*/هنل يسوي اتصال ب قاعدة البيانات */
include "db.php";

/*/هنا يسوي استدعاء البيانات من الجدول */
$cars = $conn->query("SELECT * FROM project_db");
$orders = $conn->query("SELECT * FROM orders");
?>

<h2>Cars</h2>
<table border="3">
<tr>
<th>ID</th>
<th>Brand</th>
<th>Model</th>
<th>Price</th>
</tr>

<?php while($c = $cars->fetch_assoc()) { ?>
<tr>
<td><?php echo $c['ID']; ?></td>
<td><?php echo $c['Brand']; ?></td>
<td><?php echo $c['Model']; ?></td>
<td><?php echo $c['Price']; ?></td>
</tr>
<?php } ?>
</table>

<br><br>

<h2>Orders</h2>
<table border="3">
<tr>
<th>ID</th>
<th>Car ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Address</th>
<th>Paid</th>
</tr>

<?php while($o = $orders->fetch_assoc()) { ?>
<tr>
<td><?php echo $o['id']; ?></td>
<td><?php echo $o['car_id']; ?></td>
<td><?php echo $o['full_name']; ?></td>
<td><?php echo $o['email']; ?></td>
<td><?php echo $o['phone']; ?></td>
<td><?php echo $o['address']; ?></td>
<td><?php echo $o['paid_price']; ?></td>
</tr>
<?php } ?>



