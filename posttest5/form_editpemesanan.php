<?php
include 'koneksi.php'; // Include file koneksi

$name = $age = $password = $order = $quantity = $totalHarga = "";
$hargaPerItem = 3000000; // Harga per item

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $order = htmlspecialchars($_POST['order']);
    $quantity = htmlspecialchars($_POST['quantity']);

    // Hitung total harga jika ingin memesan
    if ($order === 'Ya') {
        $totalHarga = $hargaPerItem * intval($quantity);
    } else {
        $quantity = null;
        $totalHarga = null;
    }

    // SQL untuk menyimpan data ke tabel pesanan
    $sql = "INSERT INTO pesanan (nama, umur, password, ingin_memesan, jumlah_pesanan, total_harga)
            VALUES ('$name', $age, '$password', '$order', $quantity, $totalHarga)";

    if ($conn->query($sql) === TRUE) {
        echo "Pesanan berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php
include 'koneksi.php'; // Include file koneksi

// Menampilkan data dari database
$sql = "SELECT * FROM pesanan";
$result = $conn->query($sql);
?>

<h2>Daftar Pesanan</h2>
<table border="1">
    <tr>
        <th>Nama</th>
        <th>Umur</th>
        <th>Ingin Memesan</th>
        <th>Jumlah Pesanan</th>
        <th>Total Harga</th>
        <th>Aksi</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['umur'] . "</td>";
            echo "<td>" . $row['ingin_memesan'] . "</td>";
            echo "<td>" . $row['jumlah_pesanan'] . "</td>";
            echo "<td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
            echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Belum ada pesanan.</td></tr>";
    }
    ?>
</table>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM pesanan WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $order = htmlspecialchars($_POST['order']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $totalHarga = $hargaPerItem * intval($quantity);

    $sql = "UPDATE pesanan SET nama='$name', umur=$age, ingin_memesan='$order', jumlah_pesanan=$quantity, total_harga=$totalHarga WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Pesanan berhasil diupdate!";
        header('Location: index.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<form method="post">
    Nama: <input type="text" name="name" value="<?php echo $row['nama']; ?>" required><br>
    Umur: <input type="number" name="age" value="<?php echo $row['umur']; ?>" required><br>
    Ingin Memesan: 
    <select name="order">
        <option value="Ya" <?php echo ($row['ingin_memesan'] === 'Ya') ? 'selected' : ''; ?>>Ya</option>
        <option value="Tidak" <?php echo ($row['ingin_memesan'] === 'Tidak') ? 'selected' : ''; ?>>Tidak</option>
    </select><br>
    Jumlah Pesanan: <input type="number" name="quantity" value="<?php echo $row['jumlah_pesanan']; ?>"><br>
    <button type="submit">Update</button>
</form>

<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM pesanan WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Pesanan berhasil dihapus!";
    header('Location: index.php');
} else {
    echo "Error deleting record: " . $conn->error;
}
?>

<div class="form-container">
    <h2>Form Pemesanan</h2>
    <form id="inputForm" method="post" action="">
        <div class="form-group">
            <label for="name">Nama (Text):</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
            <label for="age">Umur (Number):</label>
            <input type="number" id="age" name="age" value="<?php echo $age; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Kata Sandi (Password):</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="order">Ingin Memesan? (Ya/Tidak):</label>
            <select id="order" name="order" required onchange="toggleQuantity(this.value)">
                <option value="">-- Pilih --</option>
                <option value="Ya" <?php echo ($order === 'Ya') ? 'selected' : ''; ?>>Ya</option>
                <option value="Tidak" <?php echo ($order === 'Tidak') ? 'selected' : ''; ?>>Tidak</option>
            </select>
        </div>

        <!-- Quantity Input -->
        <div class="form-group" id="quantityGroup" style="<?php echo ($order === 'Ya') ? 'display: block;' : 'display: none;'; ?>">
            <label for="quantity">Jumlah Pesanan (Number):</label>
            <input type="number" id="quantity" name="quantity" min="1" value="<?php echo $quantity; ?>">
        </div>

        <!-- Submit Button -->
        <button type="submit">Submit</button>

    </form>

    <!-- Result Display -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div class="result" id="result">
        <p><strong>Nama:</strong> <?php echo $name; ?></p>
        <p><strong>Umur:</strong> <?php echo $age; ?></p>
        <p><strong>Kata Sandi:</strong> <?php echo str_repeat('*', strlen($password)); ?></p>
        <p><strong>Ingin Memesan:</strong> <?php echo $order; ?></p>
        <?php if ($order === 'Ya'): ?>
            <p><strong>Jumlah Pesanan:</strong> <?php echo $quantity; ?></p>
            <p><strong>Total Harga:</strong> Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>


<!-- JavaScript for handling quantity visibility -->
<script>
// Function to toggle quantity input visibility
function toggleQuantity(value) {
    const quantityGroup = document.getElementById('quantityGroup');
    if (value === 'Ya') {
        quantityGroup.style.display = 'block'; // Show quantity input
        document.getElementById('quantity').setAttribute('required', true); // Make it required
    } else {
        quantityGroup.style.display = 'none'; // Hide quantity input
        document.getElementById('quantity').removeAttribute('required'); // Remove required attribute
    }
}

// Initial call to set visibility based on previous selection
toggleQuantity('<?php echo $order; ?>');
</script>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Toko Alat Musik. All rights reserved.</p>
</footer>

</body>