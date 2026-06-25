<?php include 'includes/db.php';
$id = (int)$_GET['id'];
$row = $conn->query("SELECT * FROM bills WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Print Bill</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="print-box">
  <h2>Smart Electricity Bill</h2>
  <p><b>Consumer ID:</b> <?= $row['consumer_id'] ?></p>
  <p><b>Name:</b> <?= $row['consumer_name'] ?></p>
  <p><b>Meter Number:</b> <?= $row['meter_number'] ?></p>
  <p><b>Type:</b> <?= $row['consumer_type'] ?></p>
  <p><b>Previous Reading:</b> <?= $row['previous_reading'] ?></p>
  <p><b>Current Reading:</b> <?= $row['current_reading'] ?></p>
  <p><b>Units Consumed:</b> <?= $row['units_consumed'] ?></p>
  <p><b>Unit Rate:</b> ₹<?= $row['unit_rate'] ?></p>
  <p><b>Bill Amount:</b> ₹<?= $row['bill_amount'] ?></p>
  <p><b>Bill Date:</b> <?= $row['bill_date'] ?></p>
  <p><b>Due Date:</b> <?= $row['due_date'] ?></p>
  <p><b>Status:</b> <?= $row['payment_status'] ?></p>

  <button onclick="window.print()">Print Bill</button>
  <button onclick="downloadPDF()">Download as PDF</button>
</div>

<script>
function downloadPDF() {
  window.print();
}
</script>
</body>
</html>
