<?php
// Konfigurasi Database (Sesuaikan dengan settingan InfinityFree Anda)
$host = "sqlxxx.infinityfree.com"; // ganti dengan Host MySQL Anda
$user = "epiz_xxxxxxx";         // ganti dengan Username Database Anda
$pass = "password_anda";         // ganti dengan Password Database Anda
$db   = "epiz_xxxxxxx_exploreaceh"; // ganti dengan Nama Database Anda

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    // Jika gagal konek, tampilkan mode offline statis agar tetap bisa dilihat
    $koneksi_aktif = false;
} else {
    $koneksi_aktif = true;
}

// Tangkap Navigasi Halaman
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreAceh - Portal Budaya & Agrikultur</title>
    <style>
        :root {
            --primary-color: #1b4332;
            --secondary-color: #2d6a4f;
            --accent-color: #d8f3dc;
            --text-color: #333;
            --bg-color: #f8f9fa;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-color);
        }
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            transition: color 0.3s;
        }
        nav a:hover {
            color: var(--accent-color);
        }
        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .hero {
            text-align: center;
            padding: 40px 20px;
            background: linear-gradient(rgba(27,67,50,0.8), rgba(45,106,79,0.8)), url('https://images.unsplash.com/photo-1596401340660-f1d24c0d9225?auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            color: white;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }
        .card-body {
            padding: 15px;
        }
        .btn {
            display: inline-block;
            background-color: var(--secondary-color);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: var(--primary-color);
        }
        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        footer {
            text-align: center;
            padding: 20px;
            color: #77;
            font-size: 0.85rem;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <header>
        <h1>ExploreAceh</h1>
        <nav>
            <a href="index.php?page=home">Beranda</a>
            <a href="index.php?page=destinasi">Destinasi & Agrikultur</a>
            <a href="index.php?page=login">Login Admin</a>
        </nav>
    </header>

    <div class="container">
        <?php
        // --- HALAMAN HOME / BERANDA ---
        if ($page == 'home') {
        ?>
            <div class="hero">
                <h2>Selamat Datang di ExploreAceh</h2>
                <p>Mengenal lebih dekat kebudayaan, kearifan lokal, dan potensi agrikultur Aceh.</p>
                <a href="index.php?page=destinasi" class="btn" style="background: white; color: var(--primary-color); font-weight: bold;">Jelajahi Sekarang</a>
            </div>

            <h3>Tentang Proyek</h3>
            <p>Website ini dikembangkan untuk menampilkan informasi seputar keunggulan lokal Aceh, mulai dari sektor pertanian unggulan seperti komoditas kopi dan rempah, hingga destinasi wisata bersejarah.</p>
            
            <h3 style="margin-top: 30px;">Destinasi & Komoditas Unggulan</h3>
            <div class="grid">
                <div class="card">
                    <div class="card-body">
                        <h4>Kopi Gayo</h4>
                        <p>Komoditas kopi dataran tinggi Gayo yang mendunia dengan cita rasa khas.</p>
                        <a href="index.php?page=detail&id=1" class="btn">Lihat Detail</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4>Kawasan Agrikultur Blang</h4>
                        <p>Pusat pengembangan tradisi pertanian berbasis kearifan lokal masyarakat Aceh.</p>
                        <a href="index.php?page=detail&id=2" class="btn">Lihat Detail</a>
                    </div>
                </div>
            </div>

        <?php
        // --- HALAMAN DESTINASI / DAFTAR ---
        } elseif ($page == 'destinasi') {
        ?>
            <h2>Daftar Destinasi & Potensi Agrikultur Aceh</h2>
            <p>Berikut adalah beberapa daftar informasi penting yang terdaftar di dalam sistem:</p>
            
            <div class="grid">
                <?php
                if ($koneksi_aktif) {
                    $query = mysqli_query($koneksi, "SELECT * FROM destinasi");
                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '<div class="card"><div class="card-body">';
                            echo '<h3>' . htmlspecialchars($row['nama_destinasi']) . '</h3>';
                            echo '<p>' . substr(htmlspecialchars($row['deskripsi']), 0, 100) . '...</p>';
                            echo '<a href="index.php?page=detail&id=' . $row['id'] . '" class="btn">Selengkapnya</a>';
                            echo '</div></div>';
                        }
                    } else {
                        // Data dummy jika tabel kosong
                        echo '<div class="card"><div class="card-body"><h4>Kopi Gayo Premium</h4><p>Kopi arabika terbaik dari dataran tinggi Aceh Tengah.</p><a href="index.php?page=detail&id=1" class="btn">Selengkapnya</a></div></div>';
                        echo '<div class="card"><div class="card-body"><h4>Sentra Cabai Merah</h4><p>Hasil pertanian hortikultura unggulan wilayah Aceh.</p><a href="index.php?page=detail&id=2" class="btn">Selengkapnya</a></div></div>';
                    }
                } else {
                    // Tampilan statis pengaman jika koneksi belum diatur
                    echo '<div class="card"><div class="card-body"><h4>Kopi Gayo Premium</h4><p>Kopi arabika terbaik dari dataran tinggi Aceh Tengah.</p><a href="index.php?page=detail&id=1" class="btn">Selengkapnya</a></div></div>';
                    echo '<div class="card"><div class="card-body"><h4>Sentra Cabai Merah</h4><p>Hasil pertanian hortikultura unggulan wilayah Aceh.</p><a href="index.php?page=detail&id=2" class="btn">Selengkapnya</a></div></div>';
                }
                ?>
            </div>

        <?php
        // --- HALAMAN DETAIL ---
        } elseif ($page == 'detail') {
            $id = isset($_GET['id']) ? intval($_GET['id']) : 1;
        ?>
            <h2>Detail Informasi & Potensi</h2>
            <p>Anda sedang melihat informasi mendalam mengenai aset atau destinasi terpilih.</p>
            <hr style="border:0; border-top:1px solid #eee; margin:20px 0;">
            
            <div style="background: #fdfdfd; padding: 20px; border-radius: 8px; border: 1px solid #eee;">
                <h3>Informasi Lengkap (ID: <?php echo $id; ?>)</h3>
                <p>Halaman ini menampilkan data komprehensif, spesifikasi, serta galeri dari titik destinasi atau komoditas agrikultur terkait di Aceh.</p>
                <a href="index.php?page=destinasi" class="btn" style="background: #6c757d;">Kembali ke Daftar</a>
            </div>

        <?php
        // --- HALAMAN LOGIN ADMIN ---
        } elseif ($page == 'login') {
            session_start();
            $pesan_error = "";
            
            if (isset($_POST['login_submit'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                // Cek login sederhana (bisa disesuaikan dengan database Anda)
                if ($username == 'admin' && $password == 'admin123') {
                    $_SESSION['admin_logged'] = true;
                    header("Location: index.php?page=admin_dashboard");
                    exit;
                } else {
                    $pesan_error = "Username atau Password salah!";
                }
            }
        ?>
            <div style="max-width: 400px; margin: 0 auto;">
                <h2>Login Administrator</h2>
                <p>Masuk ke panel kontrol admin ExploreAceh.</p>
                
                <?php if (!empty($pesan_error)) { echo '<p style="color: red; background: #ffe6e6; padding: 10px; border-radius: 5px;">' . $pesan_error . '</p>'; } ?>
                
                <form method="POST" action="">
                    <label>Username:</label>
                    <input type="text" name="username" required placeholder="Masukkan username...">
                    
                    <label>Password:</label>
                    <input type="password" name="password" required placeholder="Masukkan password...">
                    
                    <button type="submit" name="login_submit" class="btn" style="width: 100%; padding: 12px; cursor: pointer;">Masuk</button>
                </form>
            </div>

        <?php
        // --- HALAMAN ADMIN DASHBOARD ---
        } elseif ($page == 'admin_dashboard') {
            session_start();
            if (!isset($_SESSION['admin_logged'])) {
                header("Location: index.php?page=login");
                exit;
            }
        ?>
            <h2>Dashboard Administrator</h2>
            <p style="color: green; font-weight: bold;">Selamat datang, Admin! Anda berhasil masuk ke panel kontrol.</p>
            <hr style="border:0; border-top:1px solid #eee; margin:20px 0;">
            
            <p>Di sini Anda dapat mengelola data destinasi, menambah informasi agrikultur, dan mengatur konten website.</p>
            <a href="index.php?page=login&action=logout" class="btn" style="background: #dc3545;" onclick="<?php session_destroy(); ?>">Keluar (Logout)</a>

        <?php
        } else {
            echo "<h2>404 - Halaman Tidak Ditemukan</h2>";
            echo "<p>Maaf, halaman yang Anda tuju tidak tersedia.</p>";
            echo '<a href="index.php?page=home" class="btn">Kembali ke Beranda</a>';
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2026 ExploreAceh - Tugas Pemrograman Web</p>
    </footer>

</body>
</html>
