<?php include 'includes/db.php'; include 'includes/header.php';

$summary = $conn->query("SELECT payment_status, COUNT(*) AS c, SUM(bill_amount) AS total FROM bills GROUP BY payment_status");
?>

<h1>Monthly Collection Report & Payment Analysis</h1>
<table>
  <tr><th>Payment Status</th><th>Total Bills</th><th>Total Amount</th></tr>
  <?php while($s=$summary->fetch_assoc()): ?>
  <tr>
    <td><?= $s['payment_status'] ?></td>
    <td><?= $s['c'] ?></td>
    <td>₹ <?= number_format($s['total'],2) ?></td>
  </tr>
  <?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>
