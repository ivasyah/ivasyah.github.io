

<?php
include 'koneksi.php'; // Include file koneksi

$name = $age = $password = $order = $quantity = $totalHarga = "";
$hargaPerItem = 3000000; // Harga per item
$imagePath = ''; // Variable to hold the image path

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $order = htmlspecialchars($_POST['order']);
    $quantity = htmlspecialchars($_POST['quantity']);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Directory where images will be uploaded
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        
        // Check if the upload directory exists, if not create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = htmlspecialchars($uploadFile); // Store the path of the uploaded image
        } else {
            echo "Error uploading file.";
        }
    }

    // Hitung total harga jika ingin memesan
    if ($order === 'Ya') {
        $totalHarga = $hargaPerItem * intval($quantity);
    } else {
        $quantity = null;
        $totalHarga = null;
    }

    // SQL untuk menyimpan data ke tabel pesanan
    $sql = "INSERT INTO pesanan (nama, umur, password, ingin_memesan, jumlah_pesanan, total_harga, image_path)
            VALUES ('$name', $age, '$password', '$order', $quantity, $totalHarga, '$imagePath')";

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
        <th>Foto</th>
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
            echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Uploaded Image' style='max-width: 100px;'></td>"; // Display uploaded image
            echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Belum ada pesanan.</td></tr>";
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
    // Handle form submission for editing the order
    // (similar logic as above for handling updates)
}

?>

<form method="post" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
    Nama: <input type="text" name="name" value="<?php echo htmlspecialchars($row['nama']); ?>" required><br>
    Umur: <input type="number" name="age" value="<?php echo htmlspecialchars($row['umur']); ?>" required><br>
    Ingin Memesan: 
    <select name="order">
        <option value="Ya" <?php echo ($row['ingin_memesan'] === 'Ya') ? 'selected' : ''; ?>>Ya</option>
        <option value="Tidak" <?php echo ($row['ingin_memesan'] === 'Tidak') ? 'selected' : ''; ?>>Tidak</option>
    </select><br>
    Jumlah Pesanan: <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['jumlah_pesanan']); ?>"><br>

    <!-- New input for image upload -->
    Foto: <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif"><br>

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