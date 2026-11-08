<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Gaji | PayRoll</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .report-card {
            background: #fff;
            border: 1px solid #e5e4de;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .report-summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .report-stat {
            background: #fff;
            border: 1px solid #e5e4de;
            border-radius: 12px;
            padding: 22px;
        }

        .report-stat p {
            margin: 0 0 12px;
            color: #777d76;
            font-size: 13px;
        }

        .report-stat h2 {
            margin: 0;
            color: #263633;
            font-size: 24px;
            overflow-wrap: anywhere;
        }

        .report-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .report-header h2 {
            margin: 0 0 6px;
            color: #263633;
            font-size: 19px;
        }

        .report-header p {
            margin: 0;
            color: #777d76;
            font-size: 13px;
        }

        .report-button {
            background: #263633;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 11px 16px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }

        .report-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            text-align: left;
        }

        .report-table th {
            background: #f7f6f2;
            color: #656b64;
            font-weight: 600;
            padding: 14px 12px;
            white-space: nowrap;
        }

        .report-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #eeeee8;
            color: #343a35;
            white-space: nowrap;
        }

        .report-empty {
            text-align: center;
            color: #777d76 !important;
            padding: 36px 12px !important;
            white-space: normal !important;
        }

        .report-total {
            margin-top: 20px;
            padding: 18px;
            background: #f7f6f2;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .report-total strong {
            color: #263633;
        }

        @media (max-width: 700px) {
            .report-summary {
                grid-template-columns: 1fr;
            }

            .report-card {
                padding: 16px;
            }
        }

        @media print {
            .sidebar,
            .topbar,
            .report-button,
            .footer {
                display: none !important;
            }

            .main-content {
                margin: 0;
                width: 100%;
            }

            .report-card,
            .report-stat {
                break-inside: avoid;
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

            <a href="penggajian.php" class="menu-link">
                <span class="menu-icon">▤</span>
                Penggajian
            </a>

            <a href="laporan.php" class="menu-link active">
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
                <h2>Laporan</h2>
                <p>Rekap dan informasi penggajian karyawan</p>
            </div>
            <div class="topbar-avatar">A</div>
        </header>

        <section class="page-content">

            <div class="page-heading">
                <div>
                    <h1>Laporan Penggajian</h1>
                    <p>Ringkasan pembayaran gaji karyawan.</p>
                </div>
            </div>

            <div class="report-summary">
                <div class="report-stat">
                    <p>Total Karyawan</p>
                    <h2>—</h2>
                </div>

                <div class="report-stat">
                    <p>Total Penggajian</p>
                    <h2>Rp —</h2>
                </div>

                <div class="report-stat">
                    <p>Sudah Dibayar</p>
                    <h2>—</h2>
                </div>
            </div>

            <div class="report-card">

                <div class="report-header">
                    <div>
                        <h2>Rekap Gaji Karyawan</h2>
                        <p>Periode penggajian</p>
                    </div>

                    <button
                        type="button"
                        class="report-button"
                        onclick="window.print()">
                        Cetak Laporan
                    </button>
                </div>

                <div class="report-table-wrap">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan</th>
                                <th>Periode</th>
                                <th>Total Gaji</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td colspan="6" class="report-empty">
                                    Belum ada data laporan penggajian.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="report-total">
                    <strong>Total Keseluruhan Gaji</strong>
                    <strong>Rp —</strong>
                </div>

            </div>

        </section>

        <footer class="footer">
            PayRoll &copy; <?= date("Y") ?>. Sistem Informasi Penggajian.
        </footer>

    </main>
</div>

</body>
</html>
