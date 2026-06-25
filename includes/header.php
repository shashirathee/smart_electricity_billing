<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Smart Electricity Billing - Shashi Project</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="layout">
  <aside class="sidebar">
    <h2>⚡ Smart Billing</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="add_bill.php">Add Bill</a>
    <a href="view_bills.php">View Bills</a>
    <a href="search_consumer.php">Search Consumer</a>
    <a href="analytics.php">Analytics</a>
    <a href="reports.php">Reports</a>
  </aside>
  <main class="main-content">
