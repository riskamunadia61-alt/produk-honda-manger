<?php
require_once 'config/db.php';
require_once 'includes/header.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit();
}

// SELECT by ID menggunakan Prepared Statement (Slide 16)[cite: 1]
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "<h3>Produk Honda tidak ditemukan!</h3>";
    echo '<a href="index.php" class="btn btn-secondary">Kembali</a>';
    exit();
}
?>

<h3>Detail Unit Honda</h3>

<div class="card" style="max-width: 500px;">
    <h2><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h2>
    <hr style="border-color: #334155; margin: 15px 0;">
    <p><strong>ID Produk:</strong> #<?= (int)$product['id'] ?></p>
    <p><strong>Kategori / Tipe:</strong> <?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Harga OTR:</strong> Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
    <p><strong>Stok Tersedia:</strong> <?= (int)$product['stock'] ?> unit</p>
    <p><strong>Tanggal Input:</strong> <?= $product['created_at'] ?></p>

    <div style="margin-top:20px; display:flex; gap:10px;">
        <a href="update.php?id=<?= $product['id'] ?>" class="btn btn-secondary" style="background:#10b981;">Edit Unit</a>
        <a href="index.php" class="btn btn-primary">Kembali ke Daftar</a>
    </div>
</div>

</div>
</body>
</html>