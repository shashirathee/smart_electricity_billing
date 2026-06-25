<?php include 'includes/db.php'; include 'includes/header.php';
$id = (int)$_GET['id'];
$msg = "";

$data = $conn->query("SELECT * FROM bills WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consumer_name = $_POST['consumer_name'];
    $meter_number = $_POST['meter_number'];
    $consumer_type = $_POST['consumer_type'];
    $previous = (float)$_POST['previous_reading'];
    $current = (float)$_POST['current_reading'];
    $unit_rate = (float)$_POST['unit_rate'];
    $bill_date = $_POST['bill_date'];
    $due_date = $_POST['due_date'];
    $payment_status = $_POST['payment_status'];

    if ($current <= $previous) {
        $msg = "<p class='error'>Current reading must be greater than previous reading.</p>";
    } else {
        $units = $current - $previous;
        $amount = $units * $unit_rate;
        $stmt = $conn->prepare("UPDATE bills SET consumer_name=?, meter_number=?, consumer_type=?, previous_reading=?, current_reading=?, units_consumed=?, unit_rate=?, bill_amount=?, bill_date=?, due_date=?, payment_status=? WHERE id=?");
        $stmt->bind_param("sssdddddsssi",$consumer_name,$meter_number,$consumer_type,$previous,$current,$units,$unit_rate,$amount,$bill_date,$due_date,$payment_status,$id);
        if ($stmt->execute()) {
            $msg = "<p class='success'>Bill updated successfully.</p>";
            $data = $conn->query("SELECT * FROM bills WHERE id=$id")->fetch_assoc();
        }
    }
}
?>

<h1>Update Bill</h1>
<?= $msg ?>
<form method="post" oninput="calculateBillUpdate()">
  <input type="text" value="<?= $data['consumer_id'] ?>" readonly>
  <input type="text" name="consumer_name" value="<?= $data['consumer_name'] ?>" required>
  <input type="text" name="meter_number" value="<?= $data['meter_number'] ?>" required>
  <input type="text" name="consumer_type" value="<?= $data['consumer_type'] ?>" required>
  <input type="number" step="0.01" name="previous_reading" id="u_previous" value="<?= $data['previous_reading'] ?>" required>
  <input type="number" step="0.01" name="current_reading" id="u_current" value="<?= $data['current_reading'] ?>" required>
  <input type="number" step="0.01" name="unit_rate" id="u_rate" value="<?= $data['unit_rate'] ?>" required>
  <input type="text" id="u_units" value="<?= $data['units_consumed'] ?>" readonly>
  <input type="text" id="u_amount" value="<?= $data['bill_amount'] ?>" readonly>
  <input type="date" name="bill_date" value="<?= $data['bill_date'] ?>" required>
  <input type="date" name="due_date" value="<?= $data['due_date'] ?>" required>
  <select name="payment_status">
    <option <?= $data['payment_status']=="Pending"?"selected":"" ?>>Pending</option>
    <option <?= $data['payment_status']=="Paid"?"selected":"" ?>>Paid</option>
  </select>
  <button type="submit">Update Bill</button>
</form>

<?php include 'includes/footer.php'; ?>
