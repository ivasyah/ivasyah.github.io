<?php
// Untuk pengaturan atau variabel dinamis, Anda bisa memasukkan PHP di sini
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loker Musik</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container">
            <h1>Loker Musik</h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#DaftarAlatMusik">Pilih Alat Music</a></li>
                    <li><a href="#about">About Me</a></li>
                </ul>
            </nav>
            <div class="dark-mode-toggle"></div>
            <label class="toggle-switch">
                <input type="checkbox" id="darkModeToggle">
                <span class="slider"></span>
            </label>
        </div>
    </header>

    <!-- Hero Section (Beranda) -->
    <section id="beranda" class="hero">
        <div class="hero-content">
            <h2>Chose Your Weapons</h2>
        </div>
    </section>

    <!-- Pembelian Alat musik -->
    <section id="DaftarAlatMusik" >
        <div class="container">
            <h1>Daftar Alat Musik</h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                </ul>
            </nav>
        </div>
            <!-- Alat Musik List Section -->
            <section class="musik-section">
                <div class="musik-gallery">
                    <?php
                    // Anda bisa membuat daftar alat musik menjadi dinamis menggunakan array
                    $alat_musik = [
                        [
                            'name' => 'Gitar - Yamaha APX5000',
                            'description' => 'Gitar Akustik.',
                            'image' => 'https://images.primanada.com/image/cache/products/yamaha-apx500ii-white-800x800.jpg',
                            'link' => 'detail_musik1.php'
                        ],
                        [
                            'name' => 'Gitar Listrik - Ephipone Lez Paul',
                            'description' => 'Gitar Elektrik.',
                            'image' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/96/MTA-143204369/br-m036969-13350_epiphone-les-paul-prophecy-electric-guitar-gitar-listrik-elektrik-_full02-f83ad244.jpg',
                            'link' => 'detail_musik2.php'
                        ],
                        [
                            'name' => 'Gitar Listrik - Ephiphone Masterbilt Century',
                            'description' => 'Gitar HollowBody.',
                            'image' => 'https://www.sweelee.co.id/cdn/shop/products/E09-EBD2VSNH1_1528362149858_1200x1200.jpg?v=1594280167',
                            'link' => 'detail_musik3.php'
                        ],
                        [
                            'name' => 'Bass - Hofner Paul McCartney',
                            'description' => 'Bass.',
                            'image' => 'https://hobby.lt/cdn/shop/files/mini-bass-guitar-paul-mccartney-the-beatles-mgt-2028_c428ef28-8390-44fb-a978-5fbd1c3847fd.jpg?v=1720739567&width=480',
                            'link' => 'detail_musik4.php'
                        ],
                        [
                            'name' => 'Drum - Yamaha Stage Custom Birch 5',
                            'description' => 'Drum.',
                            'image' => 'https://galerimusikindonesia.com/image/data/alat%20tiup%20dan%20perkusi/Cajon/Pearl%20PBC121B/cajon-pearl-primero-figured-cherry-a115025.jpg',
                            'link' => 'detail_musik5.php'
                        ],
                        [
                            'name' => 'Drum - Yamaha Stage Custom Birch 5',
                            'description' => 'Drum.',
                            'image' => 'https://sinceremusic.co.id/wp-content/uploads/2020/10/eqdRcoll.jpg',
                            'link' => 'detail_musik6.php'
                        ],
                        [
                            'name' => 'DJ Controller - Pioneer DJXDJ RX3',
                            'description' => 'DJ Controller.',
                            'image' => 'https://themasterdj.id/wp-content/uploads/2021/12/xdj-rx3-main-min-scaled.jpg',
                            'link' => 'detail_musik7.php'
                        ],
                        [
                            'name' => 'Saxophone - Alto A900 ML',
                            'description' => 'Saxophone.',
                            'image' => 'https://schagerl.com/media/8a/01/18/1700129275/A-920ML.jpg',
                            'link' => 'detail_musik8.php'
                        ],
                        [
                            'name' => 'Ukulele - Ariose AUK16',
                            'description' => 'Ukulele.',
                            'image' => 'https://ariosemusic.com/wp-content/uploads/2022/05/1-29.jpg',
                            'link' => 'detail_musik9.php'
                        ],
                    ];

                    foreach ($alat_musik as $musik) {
                        echo '
                        <div class="musik-item">
                            <a href="' . $musik['link'] . '">
                                <img src="' . $musik['image'] . '" alt="' . $musik['name'] . '">
                                <h3>' . $musik['name'] . '</h3>
                            </a>
                            <p>' . $musik['description'] . '</p>
                        </div>
                        ';
                    }
                    ?>
                </div>
            </section>
    </section>

    <!-- About Me Section -->
    <section id="about" class="about-section">
        <h2>About Me</h2>
        <p>
            Nama Saya Irvan Nurdiansyah biasa dipanggil El Dian<br>
            Saya asli Samarinda sejak lahir 13 Maret 2005<br>
            Ini nomor telpon saya 2309106070 (yakali nomor beneran)<br>
            Silahkan kunjungi profil instagram saya saja
            <a href="https://www.instagram.com/ivasyah/?utm_source=ig_web_button_share_sheet" class="ig">@ivasyah</a><br>
            Ini adalah sebuah gambaran impian saya di masa depan, yaitu membangun toko alat musik.
            dengan hobi saya bermain musik, dan saya merupakan seorang basist juga,
            saya ingin mempermudah para calon musisi untuk dapat membeli alat musik kapanpun dimanapun.<br>
        </p>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Toko Alat Musik. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>
