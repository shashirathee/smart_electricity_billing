<?php include 'includes/db.php'; include 'includes/header.php';
$result = $conn->query("SELECT * FROM bills ORDER BY id DESC");
?>

<h1>View Bills</h1>
<div class="table-wrap">
<table>
  <tr>
    <th>ID</th><th>Consumer ID</th><th>Name</th><th>Units</th><th>Amount</th><th>Status</th><th>Bill Date</th><th>Actions</th>
  </tr>
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['consumer_id'] ?></td>
    <td><?= $row['consumer_name'] ?></td>
    <td><?= $row['units_consumed'] ?></td>
    <td>₹ <?= $row['bill_amount'] ?></td>
    <td><?= $row['payment_status'] ?></td>
    <td><?= $row['bill_date'] ?></td>
    <td>
      <a href="update_bill.php?id=<?= $row['id'] ?>">Edit</a> |
      <a href="delete_bill.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this bill?')">Delete</a> |
      <a href="print_bill.php?id=<?= $row['id'] ?>" target="_blank">Print/PDF</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
</div>

<?php include 'includes/footer.php'; ?>
