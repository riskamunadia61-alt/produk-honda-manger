<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honda Product Manager</title>
    <!-- Menghubungkan ke file CSS terpisah di folder css/style.css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="header-title">
        <h1>Honda Product Manager</h1>
        <span style="color: #94a3b8; font-size: 14px;">Sistem Manajemen Produk Unit Honda</span>
    </div>