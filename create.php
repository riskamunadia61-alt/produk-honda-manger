<?php
require_once 'config/db.php';
require_once 'includes/header.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi Anti-CSRF Token (Slide 16)[cite: 1]
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Akses ditolak: Token CSRF tidak valid!");
    }

    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);

    // Validasi Server (Slide 16): nama >= 3, harga > 0, stok >= 0[cite: 1]
    if (strlen($name) < 3) $errors[] = "Nama produk Honda minimal 3 karakter!";
    if ($price === false || $price <= 0) $errors[] = "Harga harus lebih besar dari 0!";
    if ($stock === false || $stock < 0) $errors[] = "Stok unit tidak boleh negatif!";

    if (empty($errors)) {
        // Prepared Statement PDO (Slide 16)[cite: 1]
        $stmt = $pdo->prepare("INSERT INTO products (name, category, price, stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $category, $price, $stock]);

        // Pattern PRG (Post/Redirect/Get) (Slide 17)[cite: 1]
        header("Location: index.php");
        exit();
    }
}
?>

<h3>Tambah Unit Honda Baru</h3>

<?php if (!empty($errors)): ?>
    <div class="alert-error">
        <?php foreach ($errors as $err): ?>
            <p style="margin: 3px 0;">• <?= htmlspecialchars($err) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" action="create.php">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <div class="form-group">
        <label>Nama Unit (Min. 3 Karakter)</label>
        <input type="text" name="name" placeholder="Contoh: Honda PCX 160" required>
    </div>
    <div class="form-group">
        <label>Kategori / Tipe</label>
        <input type="text" name="category" placeholder="Contoh: Matic / Sport / Cub" required>
    </div>
    <div class="form-group">
        <label>Harga OTR (> 0)</label>
        <input type="number" step="0.01" name="price" placeholder="Contoh: 32500000" required>
    </div>
    <div class="form-group">
        <label>Stok Unit (≥ 0)</label>
        <input type="number" name="stock" placeholder="Contoh: 10" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Unit</button>
    <a href="index.php" style="color:#94a3b8; margin-left:15px; text-decoration:none;">Batal</a>
</form>

</div>
</body>
</html>