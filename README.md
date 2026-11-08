# project frontend penggajian-app
<?php
$nama = "";
$jabatan = "";
$gajiPokok = 0;
$tunjangan = 0;
$lembur = 0;
$potongan = 0;
$bonus = 0;
$totalGaji = 0;
$dihitung = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $jabatan = trim($_POST["jabatan"] ?? "");
    $gajiPokok = max(0, (float) ($_POST["gaji_pokok"] ?? 0));
    $tunjangan = max(0, (float) ($_POST["tunjangan"] ?? 0));
    $lembur = max(0, (float) ($_POST["lembur"] ?? 0));
    $potongan = max(0, (float) ($_POST["potongan"] ?? 0));
    $bonus = max(0, (float) ($_POST["bonus"] ?? 0));

    if ($nama !== "" && $jabatan !== "") {
        $totalGaji = $gajiPokok + $tunjangan + $lembur + $bonus - $potongan;
        $totalGaji = max(0, $totalGaji);
        $dihitung = true;
    }
}

function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggajian | PayRoll</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .payroll-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, .8fr);
            gap: 24px;
            align-items: start;
        }

        .payroll-panel {
            background: #fff;
            border: 1px solid #e5e4de;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .payroll-panel h2 {
            margin: 0 0 8px;
            color: #263633;
            font-size: 19px;
        }

        .panel-description {
            color: #777d76;
            font-size: 13px;
            margin: 0 0 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #343a35;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 13px;
            border: 1px solid #dedfd8;
            border-radius: 8px;
            background: #fff;
            color: #252824;
            font: inherit;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #526c5e;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 16px;
        }

        .payroll-button {
            width: 100%;
            border: none;
            border-radius: 8px;
            padding: 13px;
            background: #263633;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .payroll-button:hover {
            background: #3b5148;
        }

        .salary-result {
            background: #263633;
            color: white;
            padding: 24px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .salary-result small {
            color: #d2ded5;
        }

        .salary-total {
            font-size: 28px;
            font-weight: 700;
            margin-top: 10px;
            overflow-wrap: anywhere;
        }

        .salary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid #e9e9e3;
            font-size: 13px;
        }

        .salary-row span:last-child {
            text-align: right;
            font-weight: 600;
        }

        .salary-row.total {
            border-bottom: none;
            color: #263633;
            font-size: 15px;
            font-weight: 700;
        }

        .result-placeholder {
            color: #777d76;
            text-align: center;
            padding: 30px 10px;
            line-height: 1.7;
        }

        .result-placeholder .placeholder-icon {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .notice-error {
            background: #fff1ee;
            color: #9b3427;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        @media (max-width: 900px) {
            .payroll-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 500px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .payroll-panel {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

<div class="app-container">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">P</div>
            <span>PayRoll</span>
        </div>

        <div class="sidebar-label">MENU UTAMA</div>

        <nav class="sidebar-menu">
            <a href="index.php" class="menu-link">
                <span class="menu-icon">▦</span>
                Dashboard
            </a>
            <a href="karyawan.php" class="menu-link">
                <span class="menu-icon">♙</span>
                Data Karyawan
            </a>
            <a href="hitung-gaji.php" class="menu-link active">
                <span class="menu-icon">▤</span>
                Penggajian
            </a>
            <a href="laporan.php" class="menu-link">
                <span class="menu-icon">▧</span>
                Laporan
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="admin-profile">
                <div class="avatar">A</div>
                <div>
                    <strong>Admin</strong>
                    <small>Administrator</small>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <div>
                <h2>Penggajian</h2>
                <p>Kelola dan hitung gaji karyawan</p>
            </div>
            <div class="topbar-avatar">A</div>
        </header>

        <section class="page-content">

            <div class="page-heading">
                <div>
                    <h1>Perhitungan Gaji</h1>
                    <p>Masukkan rincian gaji untuk menghitung total gaji karyawan.</p>
                </div>
            </div>

            <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !$dihitung): ?>
                <div class="notice-error">
                    Nama dan jabatan wajib diisi.
                </div>
            <?php endif; ?>

            <div class="payroll-layout">

                <section class="payroll-panel">
                    <h2>Data Penggajian</h2>
                    <p class="panel-description">
                        Lengkapi informasi karyawan dan komponen gajinya.
                    </p>

                    <form method="POST" action="hitung-gaji.php">

                        <div class="form-group">
                            <label for="nama">Nama Karyawan</label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                placeholder="Masukkan nama karyawan"
                                value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select id="jabatan" name="jabatan" required>
                                <option value="">Pilih jabatan</option>
                                <?php
                                $daftarJabatan = [
                                    "Manager",
                                    "Supervisor",
                                    "Staff Administrasi",
                                    "Staff Keuangan",
                                    "Staff IT"
                                ];
                                foreach ($daftarJabatan as $item):
                                ?>
                                    <option
                                        value="<?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?>"
                                        <?= $jabatan === $item ? "selected" : "" ?>
                                    >
                                        <?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok (Rp)</label>
                                <input type="number" id="gaji_pokok"
                                    name="gaji_pokok" min="0" step="1000"
                                    value="<?= $gajiPokok ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tunjangan">Tunjangan (Rp)</label>
                                <input type="number" id="tunjangan"
                                    name="tunjangan" min="0" step="1000"
                                    value="<?= $tunjangan ?>">
                            </div>

                            <div class="form-group">
                                <label for="lembur">Uang Lembur (Rp)</label>
                                <input type="number" id="lembur"
                                    name="lembur" min="0" step="1000"
                                    value="<?= $lembur ?>">
                            </div>

                            <div class="form-group">
                                <label for="bonus">Bonus (Rp)</label>
                                <input type="number" id="bonus"
                                    name="bonus" min="0" step="1000"
                                    value="<?= $bonus ?>">
                            </div>

                            <div class="form-group">
                                <label for="potongan">Potongan (Rp)</label>
                                <input type="number" id="potongan"
                                    name="potongan" min="0" step="1000"
                                    value="<?= $potongan ?>">
                            </div>
                        </div>

                        <button type="submit" class="payroll-button">
                            Hitung Gaji
                        </button>

                    </form>
                </section>

                <section class="payroll-panel">
                    <h2>Hasil Perhitungan</h2>
                    <p class="panel-description">
                        Ringkasan gaji bersih karyawan.
                    </p>

                    <?php if ($dihitung): ?>

                        <div class="salary-result">
                            <small>Total Gaji Bersih</small>
                            <div class="salary-total">
                                <?= rupiah($totalGaji) ?>
                            </div>
                            <p>
                                <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        </div>

                        <div class="salary-row">
                            <span>Jabatan</span>
                            <span><?= htmlspecialchars($jabatan, ENT_QUOTES, 'UTF-8') ?></span>
                        </div>

                        <div class="salary-row">
                            <span>Gaji Pokok</span>
                            <span><?= rupiah($gajiPokok) ?></span>
                        </div>

                        <div class="salary-row">
                            <span>Tunjangan</span>
                            <span><?= rupiah($tunjangan) ?></span>
                        </div>

                        <div class="salary-row">
                            <span>Uang Lembur</span>
                            <span><?= rupiah($lembur) ?></span>
                        </div>

                        <div class="salary-row">
                            <span>Bonus</span>
                            <span><?= rupiah($bonus) ?></span>
                        </div>

                        <div class="salary-row">
                            <span>Potongan</span>
                            <span>- <?= rupiah($potongan) ?></span>
                        </div>

                        <div class="salary-row total">
                            <span>Total Gaji</span>
                            <span><?= rupiah($totalGaji) ?></span>
                        </div>

                    <?php else: ?>

                        <div class="result-placeholder">
                            <div class="placeholder-icon">▤</div>
                            <strong>Belum Ada Hasil</strong>
                            <p>
                                Isi form penggajian di sebelah kiri,
                                lalu klik tombol Hitung Gaji.
                            </p>
                        </div>

                    <?php endif; ?>
                </section>

            </div>
        </section>

        <footer class="footer">
            PayRoll &copy; <?= date("Y") ?>. Sistem Informasi Penggajian.
        </footer>

    </main>
</div>

</body>
</html>
