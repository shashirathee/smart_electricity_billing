<?php include 'includes/db.php'; include 'includes/header.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consumer_id = trim($_POST['consumer_id']);
    $consumer_name = trim($_POST['consumer_name']);
    $meter_number = trim($_POST['meter_number']);
    $consumer_type = $_POST['consumer_type'];
    $previous_reading = (float)$_POST['previous_reading'];
    $current_reading = (float)$_POST['current_reading'];
    $unit_rate = (float)$_POST['unit_rate'];
    $bill_date = $_POST['bill_date'];
    $due_date = $_POST['due_date'];
    $payment_status = $_POST['payment_status'];

    if ($current_reading <= $previous_reading) {
        $msg = "<p class='error'>Current reading must be greater than previous reading.</p>";
    } else {
        $units = $current_reading - $previous_reading;
        $amount = $units * $unit_rate;

        $check = $conn->prepare("SELECT id FROM bills WHERE consumer_id=?");
        $check->bind_param("s", $consumer_id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $msg = "<p class='error'>Duplicate Consumer ID not allowed.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO bills(consumer_id,consumer_name,meter_number,consumer_type,previous_reading,current_reading,units_consumed,unit_rate,bill_amount,bill_date,due_date,payment_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssddddddss",$consumer_id,$consumer_name,$meter_number,$consumer_type,$previous_reading,$current_reading,$units,$unit_rate,$amount,$bill_date,$due_date,$payment_status);

            if ($stmt->execute()) $msg = "<p class='success'>Bill added successfully.</p>";
            else $msg = "<p class='error'>Error: ".$conn->error."</p>";
        }
    }
}
?>

<h1>Add Bill</h1>
<?= $msg ?>
<form method="post" oninput="calculateBill()">
  <input type="text" name="consumer_id" placeholder="Consumer ID" required>
  <input type="text" name="consumer_name" placeholder="Consumer Name" required>
  <input type="text" name="meter_number" placeholder="Meter Number" required>

  <select name="consumer_type" required>
    <option value="">Select Consumer Type</option>
    <option>Residential</option>
    <option>Commercial</option>
    <option>Industrial</option>
  </select>

  <input type="number" step="0.01" name="previous_reading" id="previous_reading" placeholder="Previous Reading" required>
  <input type="number" step="0.01" name="current_reading" id="current_reading" placeholder="Current Reading" required>
  <input type="number" step="0.01" name="unit_rate" id="unit_rate" placeholder="Unit Rate" required>

  <input type="text" id="units_consumed" placeholder="Units Consumed (Auto)" readonly>
  <input type="text" id="bill_amount" placeholder="Bill Amount (Auto)" readonly>

  <label>Bill Date</label><input type="date" name="bill_date" required>
  <label>Due Date</label><input type="date" name="due_date" required>

  <select name="payment_status" required>
    <option>Pending</option>
    <option>Paid</option>
  </select>

  <button type="submit">Save Bill</button>
</form>

<?php include 'includes/footer.php'; ?>
