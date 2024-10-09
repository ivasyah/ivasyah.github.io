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
