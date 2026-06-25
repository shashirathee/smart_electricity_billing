<?php include 'includes/db.php'; include 'includes/header.php';
$where = "WHERE 1=1";

if (!empty($_GET['consumer_name'])) {
    $name = $conn->real_escape_string($_GET['consumer_name']);
    $where .= " AND consumer_name LIKE '%$name%'";
}
if (!empty($_GET['consumer_id'])) {
    $cid = $conn->real_escape_string($_GET['consumer_id']);
    $where .= " AND consumer_id LIKE '%$cid%'";
}
if (!empty($_GET['consumer_type'])) {
    $type = $conn->real_escape_string($_GET['consumer_type']);
    $where .= " AND consumer_type='$type'";
}
if (!empty($_GET['payment_status'])) {
    $ps = $conn->real_escape_string($_GET['payment_status']);
    $where .= " AND payment_status='$ps'";
}
if (!empty($_GET['bill_date'])) {
    $bd = $conn->real_escape_string($_GET['bill_date']);
    $where .= " AND bill_date='$bd'";
}

$result = $conn->query("SELECT * FROM bills $where ORDER BY id DESC");
?>

<h1>Search & Filter Consumers</h1>
<form method="get">
  <input type="text" name="consumer_name" placeholder="Search by Name">
  <input type="text" name="consumer_id" placeholder="Search by Consumer ID">
  <select name="consumer_type"><option value="">All Types</option><option>Residential</option><option>Commercial</option><option>Industrial</option></select>
  <select name="payment_status"><option value="">All Status</option><option>Paid</option><option>Pending</option></select>
  <input type="date" name="bill_date">
  <button type="submit">Search</button>
</form>

<table>
  <tr><th>Consumer ID</th><th>Name</th><th>Type</th><th>Units</th><th>Amount</th><th>Status</th></tr>
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['consumer_id'] ?></td>
    <td><?= $row['consumer_name'] ?></td>
    <td><?= $row['consumer_type'] ?></td>
    <td><?= $row['units_consumed'] ?></td>
    <td>₹ <?= $row['bill_amount'] ?></td>
    <td><?= $row['payment_status'] ?></td>
  </tr>
  <?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>
