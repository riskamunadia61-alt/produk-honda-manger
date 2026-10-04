<?php
require_once 'config/db.php';
require_once 'includes/header.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit(); }

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) { die("Data produk Honda tidak ditemukan!"); }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Akses ditolak: Token CSRF tidak valid!");
    }

    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);

    if (strlen($name) < 3) $errors[] = "Nama produk Honda minimal 3 karakter!";
    if ($price === false || $price <= 0) $errors[] = "Harga harus lebih besar dari 0!";
    if ($stock === false || $stock < 0) $errors[] = "Stok unit tidak boleh negatif!";

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->execute([$name, $category, $price, $stock, $id]);

        header("Location: index.php");
        exit();
    }
}
?>

<h3>Edit Data Unit Honda</h3>

<?php if (!empty($errors)): ?>
    <div class="alert-error">
        <?php foreach ($errors as $err): ?>
            <p style="margin: 3px 0;">• <?= htmlspecialchars($err) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" action="update.php?id=<?= $product['id'] ?>">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <div class="form-group">
        <label>Nama Unit</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>
    <div class="form-group">
        <label>Kategori / Tipe</label>
        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>
    </div>
    <div class="form-group">
        <label>Harga OTR</label>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>
    </div>
    <div class="form-group">
        <label>Stok Unit</label>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Data</button>
    <a href="index.php" style="color:#94a3b8; margin-left:15px; text-decoration:none;">Batal</a>
</form>

</div>
</body>
</html>