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
