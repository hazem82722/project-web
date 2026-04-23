<?php
include "db.php";

$cars = $conn->query("SELECT * FROM project_db");
$orders = $conn->query("SELECT * FROM orders");
?>

<h2>Cars</h2>
<table border="1">
<tr>
<th>ID</th><th>Brand</th><th>Model</th>
</tr>

<?php while($c = $cars->fetch_assoc()) { ?>
<tr>
<td><?php echo $c['ID']; ?></td>
<td><?php echo $c['Brand']; ?></td>
<td><?php echo $c['Model']; ?></td>
</tr>
<?php } ?>
</table>

<h2>Orders</h2>
<table border="1">
<tr>
<th>ID</th><th>Car ID</th><th>Name</th>
</tr>

<?php while($o = $orders->fetch_assoc()) { ?>
<tr>
<td><?php echo $o['id']; ?></td>
<td><?php echo $o['car_id']; ?></td>
<td><?php echo $o['full_name']; ?></td>
</tr>
<?php } ?>
</table>