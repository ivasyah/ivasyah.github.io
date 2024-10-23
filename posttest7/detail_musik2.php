<?php
// Initialize variables
$name = '';
$age = '';
$password = '';
$order = '';
$quantity = '';
$totalHarga = 0;
$hargaPerItem = 12000000; // Price per item
$imagePath = ''; // Variable to hold the image path

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $password = htmlspecialchars($_POST['password']);
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

    if ($order === 'Ya') {
        $totalHarga = $hargaPerItem * intval($quantity);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail musik 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header -->
<header>
    <div class="container">
        <h1>Detail Alat Musik</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Alat Musik Detail Section -->
<section class="musik-detail">
    <div class="musik-image">
        <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/96/MTA-143204369/br-m036969-13350_epiphone-les-paul-prophecy-electric-guitar-gitar-listrik-elektrik-_full02-f83ad244.jpg" alt="Gitar">
    </div>
    <div class="musik-info">
        <h2>GITAR</h2>
        <p><strong>Brand:</strong> Ephiphone</p>
        <p><strong>Nama Model:</strong> Lez Paul</p>
        <p><strong>Harga:</strong> Rp. 4.500.000,00</p>
        <p><strong>Status:</strong> New</p>
        <p><strong>Jenis:</strong> Elektrik</p>
               <p> <a href="form_editpemesanan.php"> <strong>Klik Disini untuk Melihat pesanan</strong> </a>
        <p>Atur distorsi sesuka anda.</p>
    </div>
</section>

<header>
    <div class="container">
        <h1>Order Now?</h1>
        <nav>
            <ul>
                <li><a href="#">detail alat musik</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Form pemesanan alat musik Section -->
<div class="form-container">
    <h2>Form Pemesanan</h2>
    <form id="inputForm" method="post" action="" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
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

        <!-- Image Upload Input -->
        <div class="form-group">
            <label for="image">Upload Foto:</label> <!-- New input for image upload -->
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif"> <!-- Accepting common image formats -->
        </div>

        <!-- Submit Button -->
        <button type="submit">Submit</button>

    </form>

    <!-- Result Display -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div class="result" id="result">
        <?php if ($imagePath): ?>
            <!-- Display uploaded image -->
            <p><strong>Uploaded Image:</strong></p>
            <img src="<?php echo $imagePath; ?>" alt="Uploaded Image" style="max-width: 200px; max-height: 200px;">
        <?php endif; ?>
        
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
</html>
