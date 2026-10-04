<?php
require_once 'config/db.php';
require_once 'includes/header.php';

// Fitur Bonus: Filter Pencarian via GET Parameter
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if (!empty($q)) {
    $searchTerm = "%$q%";
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ? ORDER BY id DESC");
    $stmt->execute([$searchTerm, $searchTerm]);
} else {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
}
$products = $stmt->fetchAll();
?>

<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
    <a href="create.php" class="btn btn-primary">+ Tambah Unit Honda</a>
    <form method="GET" action="index.php" style="display:flex; gap:10px;">
        <input type="text" name="q" placeholder="Cari nama / tipe motor..." value="<?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit" class="btn btn-secondary">Cari</button>
    </form>
</div>

<div class="card-grid">
    <?php if (empty($products)): ?>
        <p style="color:#94a3b8;">Belum ada unit Honda yang terdaftar.</p>
    <?php else: ?>
        <?php foreach ($products as $p): ?>
            <div class="card">
                <!-- Anti-XSS via htmlspecialchars (Slide 16 & 20)[cite: 1] -->
                <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($p['category'], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Harga OTR:</strong> Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                <p><strong>Stok Unit:</strong> <?= (int)$p['stock'] ?> unit</p>
                <div style="margin-top:15px; display:flex; gap:8px; flex-wrap:wrap;">
                    <a href="read.php?id=<?= $p['id'] ?>" class="btn btn-secondary" style="font-size:12px;">Detail</a>
                    <a href="update.php?id=<?= $p['id'] ?>" class="btn btn-secondary" style="font-size:12px; background:#10b981;">Edit</a>
                    <form method="POST" action="delete.php" style="display:inline;" onsubmit="return confirm('Hapus unit Honda ini?');">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <button type="submit" class="btn btn-danger" style="font-size:12px;">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</div>
</body>
</html>