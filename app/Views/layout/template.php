<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gudang Percetakan' ?></title>
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

    <div class="wrapper">
        <!-- SIDEBAR -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <div class="d-flex align-items-center">
                    <i class="fas fa-boxes fa-2x text-tokopedia me-2"></i>
                    <div>
                        <h5 class="mb-0 fw-bold text-tokopedia">GudangPrint</h5>
                        <small class="text-muted" style="font-size: 0.8rem;">Sistem Manajemen Stok</small>
                    </div>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="<?= base_url('dashboard') ?>" class="<?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                        <i class="fas fa-home me-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('barang') ?>" class="<?= uri_string() == 'barang' ? 'active' : '' ?>">
                        <i class="fas fa-box-open me-3"></i> Data Barang
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalTrx">
                        <i class="fas fa-exchange-alt me-3"></i> Input Transaksi
                    </a>
                </li>
            </ul>
            
            <div class="mt-auto p-4 border-top">
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger w-100 btn-sm">
                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                </a>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <div class="content-wrapper">
            <!-- NAVBAR (UPDATE: ADA SEARCH) -->
            <nav class="navbar navbar-light bg-white border-bottom px-4">
                <div class="container-fluid">
                    <!-- 1. Tombol Toggle Mobile -->
                    <button class="btn btn-link text-tokopedia d-md-none"><i class="fas fa-bars"></i></button>
                    
                    <!-- 2. SEARCH BAR (UPDATE: SUDAH BERFUNGSI) -->
            <!-- Action mengarah ke Controller Barang -->
            <form action="<?= base_url('barang') ?>" method="get" class="d-none d-md-flex ms-4 w-50">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                    <!-- Name="keyword" wajib ada buat ditangkap Controller -->
                    <input type="text" name="keyword" class="form-control border-start-0 bg-light" placeholder="Cari kode atau nama barang..." value="<?= $keyword ?? '' ?>">
                </div>
            </form>

                    <!-- 3. Profil User -->
                    <div class="ms-auto d-flex align-items-center">
                        <div class="text-end me-3 d-none d-sm-block">
                            <span class="d-block fw-bold text-dark"><?= session()->get('nama') ?></span>
                            <span class="d-block text-muted small text-uppercase" style="font-size: 0.7rem;">
                                <?= session()->get('role') ?>
                            </span>
                        </div>
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-tokopedia" style="width: 40px; height: 40px;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- KONTEN DINAMIS -->
            <div class="main-content">
                <?= $this->renderSection('content') ?>
            </div>

            <footer class="text-center py-3 text-muted border-top small bg-white">
                &copy; <?= date('Y') ?> Aplikasi Gudang Percetakan - UAS Web 2
            </footer>
        </div>
    </div>

    <!-- MODAL TRANSAKSI -->
    <div class="modal fade" id="modalTrx">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-tokopedia">
                    <h5 class="modal-title fw-bold text-white">Input Transaksi Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('transaksi/proses') ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold mb-1">Pilih Barang</label>
                            <select name="id_barang" class="form-select" required>
                                <?php 
                                $db = \Config\Database::connect();
                                $brg = $db->table('barang')->get()->getResultArray();
                                foreach($brg as $b) echo "<option value='{$b['id_barang']}'>{$b['nama_barang']} (Stok: {$b['stok']})</option>"; 
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="fw-bold mb-1">Jenis</label>
                                <select name="jenis_transaksi" class="form-select">
                                    <option value="masuk">Masuk (+)</option>
                                    <option value="keluar">Keluar (-)</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="fw-bold mb-1">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" required min="1">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold mb-1">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold mb-1">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Pembelian baru..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-tokopedia w-100">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>