<?php
include 'includes/db.php';
$id = (int)$_GET['id'];
$conn->query("DELETE FROM bills WHERE id=$id");
header("Location: view_bills.php");
exit;
