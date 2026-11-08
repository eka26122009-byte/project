<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan | PayRoll</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="app-container">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">P</div>
            <div>
                <h2>PayRoll</h2>
                <small>Sistem Penggajian</small>
            </div>
        </div>

        <p class="sidebar-label">MENU UTAMA</p>

        <nav class="menu">
            <a href="index.php" class="menu-item">
                <span>⌂</span> Dashboard
            </a>

            <a href="karyawan.php" class="menu-item active">
                <span>♙</span> Data Karyawan
            </a>

            <a href="penggajian.php" class="menu-item">
                <span>▤</span> Penggajian
            </a>

            <a href="laporan.php" class="menu-item">
                <span>▣</span> Laporan
            </a>
        </nav>

        <!-- PROFIL ADMIN -->
        <div class="profile">
            <div class="profile-avatar">A</div>
            <div class="profile-info">
                <small>Selamat datang,</small>
                <strong>Admin</strong>
            </div>
        </div>
    </aside>

    <!-- KONTEN DATA KARYAWAN -->
    <main class="main-content">

        <header class="topbar">
            <p>Sistem Informasi Penggajian</p>

            <div class="topbar-right">
                <span>Oktober 2026</span>
                <div class="topbar-avatar">A</div>
            </div>
        </header>

        <!-- JUDUL HALAMAN -->
        <section class="page-heading">
            <div>
                <p class="eyebrow">MANAJEMEN DATA</p>
                <h1>Data Karyawan</h1>
                <p class="welcome-description">
                    Kelola informasi karyawan perusahaan.
                </p>
            </div>
        </section>

        <!-- PENCARIAN DAN TOMBOL TAMBAH -->
        <section class="toolbar">
            <input
                type="search"
                id="searchEmployee"
                placeholder="Cari nama karyawan..."
                aria-label="Cari nama karyawan"
            >

            <button
                type="button"
                class="btn-primary"
                onclick="alert('Fitur tambah karyawan akan dihubungkan ke backend.')"
            >
                + Tambah Karyawan
            </button>
        </section>

        <!-- TABEL KARYAWAN -->
        <section class="data-section">

            <div class="table-wrapper">
                <table class="activity-table employee-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Masa Kerja</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="employeeTable">
                        <!-- Data karyawan akan ditampilkan dari backend -->
                        <tr>
                            <td colspan="7" class="empty-table">
                                Belum ada data karyawan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p id="emptyMessage" class="empty-message" hidden>
                Data karyawan tidak ditemukan.
            </p>

            <div class="table-footer">
                Data karyawan akan ditampilkan setelah terhubung ke backend.
            </div>

        </section>

        <footer class="footer">
            <span>PAYROLL MANAGEMENT SYSTEM</span>
            <span>2026</span>
        </footer>

    </main>

</div>

<script>
    const searchInput = document.getElementById('searchEmployee');
    const employeeTable = document.getElementById('employeeTable');
    const emptyMessage = document.getElementById('emptyMessage');

    searchInput.addEventListener('input', function () {
        const keyword = this.value.trim().toLowerCase();
        const rows = employeeTable.querySelectorAll('tr');
        let visibleCount = 0;
        let hasEmployeeData = false;

        rows.forEach(function (row) {
            // Abaikan baris pesan kosong
            if (row.querySelectorAll('td').length === 1) {
                return;
            }

            hasEmployeeData = true;

            const match = row.textContent.toLowerCase().includes(keyword);
            row.hidden = !match;

            if (match) {
                visibleCount++;
            }
        });

        emptyMessage.hidden =
            !hasEmployeeData || keyword === '' || visibleCount > 0;
    });
</script>

</body>
</html>
