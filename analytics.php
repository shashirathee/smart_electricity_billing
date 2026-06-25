<?php include 'includes/db.php'; include 'includes/header.php';

$monthly = $conn->query("SELECT DATE_FORMAT(bill_date,'%Y-%m') AS m, SUM(bill_amount) AS total FROM bills GROUP BY m ORDER BY m");
$pendingDefaulters = $conn->query("SELECT consumer_name, consumer_id, bill_amount, due_date FROM bills WHERE payment_status='Pending' ORDER BY due_date ASC");
$top = $conn->query("SELECT consumer_name, units_consumed FROM bills ORDER BY units_consumed DESC LIMIT 5");
?>

<h1>Analytics Module</h1>

<h3>Revenue Analytics Dashboard (Month-wise)</h3>
<table>
  <tr><th>Month</th><th>Revenue</th></tr>
  <?php while($r=$monthly->fetch_assoc()): ?>
  <tr><td><?= $r['m'] ?></td><td>₹ <?= number_format($r['total'],2) ?></td></tr>
  <?php endwhile; ?>
</table>

<h3>Highest Consumption Dashboard (Top 5)</h3>
<table>
  <tr><th>Consumer</th><th>Units</th></tr>
  <?php while($t=$top->fetch_assoc()): ?>
  <tr><td><?= $t['consumer_name'] ?></td><td><?= $t['units_consumed'] ?></td></tr>
  <?php endwhile; ?>
</table>

<h3>Defaulter Tracking System</h3>
<table>
  <tr><th>Consumer Name</th><th>Consumer ID</th><th>Amount</th><th>Due Date</th></tr>
  <?php while($d=$pendingDefaulters->fetch_assoc()): ?>
  <tr><td><?= $d['consumer_name'] ?></td><td><?= $d['consumer_id'] ?></td><td>₹ <?= $d['bill_amount'] ?></td><td><?= $d['due_date'] ?></td></tr>
  <?php endwhile; ?>
</table>

<p><b>Unit Consumption Forecast:</b> Basic student-level forecast can be estimated as average of last 3 bills per consumer (can be added in viva as future enhancement).</p>

<?php include 'includes/footer.php'; ?>
