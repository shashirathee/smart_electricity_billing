<?php
if (!isset($pageTitle)) {
    $pageTitle = "Smart Electricity Billing";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="main-wrapper">
  <aside class="sidebar">
    <h2>⚡ Shashi Billing</h2>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="add_bill.php">Add Bill</a></li>
      <li><a href="view_bills.php">View Bills</a></li>
      <li><a href="search_consumer.php">Search Consumer</a></li>
      <li><a href="analytics.php">Analytics</a></li>
      <li><a href="reports.php">Reports</a></li>
    </ul>
  </aside>
  <div class="content-area">
    <header class="topbar">
      <h1><?php echo $pageTitle; ?></h1>
      <p>Smart Electricity Billing & Energy Consumption Analytics System</p>
    </header>
