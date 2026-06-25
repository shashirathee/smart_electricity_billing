<?php include 'includes/db.php'; include 'includes/header.php';

$totalConsumers = $conn->query("SELECT COUNT(*) AS c FROM bills")->fetch_assoc()['c'];
$totalRevenue = $conn->query("SELECT IFNULL(SUM(bill_amount),0) AS r FROM bills WHERE payment_status='Paid'")->fetch_assoc()['r'];
$pending = $conn->query("SELECT COUNT(*) AS p FROM bills WHERE payment_status='Pending'")->fetch_assoc()['p'];
$paid = $conn->query("SELECT COUNT(*) AS p FROM bills WHERE payment_status='Paid'")->fetch_assoc()['p'];

$highest = $conn->query("SELECT consumer_name, units_consumed FROM bills ORDER BY units_consumed DESC LIMIT 1");
$highestRow = $highest->num_rows ? $highest->fetch_assoc() : ['consumer_name'=>'N/A','units_consumed'=>0];

$monthly = $conn->query("SELECT DATE_FORMAT(bill_date,'%Y-%m') AS m, IFNULL(SUM(bill_amount),0) AS total 
                         FROM bills WHERE payment_status='Paid' GROUP BY m ORDER BY m DESC LIMIT 6");
?>

<h1>Dashboard</h1>
<div class="cards">
  <div class="card"><h3>Total Consumers</h3><p><?= $totalConsumers ?></p></div>
  <div class="card"><h3>Total Revenue</h3><p>₹ <?= number_format($totalRevenue,2) ?></p></div>
  <div class="card"><h3>Pending Payments</h3><p><?= $pending ?></p></div>
  <div class="card"><h3>Paid Bills</h3><p><?= $paid ?></p></div>
  <div class="card"><h3>Highest Consumption</h3><p><?= $highestRow['consumer_name'] ?> (<?= $highestRow['units_consumed'] ?> units)</p></div>
</div>

<h2>Monthly Collection Summary</h2>
<table>
  <tr><th>Month</th><th>Collection (₹)</th></tr>
  <?php while($row = $monthly->fetch_assoc()): ?>
    <tr><td><?= $row['m'] ?></td><td><?= number_format($row['total'],2) ?></td></tr>
  <?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>
