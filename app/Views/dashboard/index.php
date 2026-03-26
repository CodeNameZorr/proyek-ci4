<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Judul -->
<div class="mb-4">
    <h3 class="fw-bold text-dark">Dashboard Ringkasan</h3>
    <p class="text-muted">Pantau arus keluar masuk barang secara real-time.</p>
</div>

<!-- 1. KARTU STATISTIK (Tetap) -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card card-stat p-3 border-start border-5 border-primary h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-muted small fw-bold">Total Item</h6>
                    <h2 class="mb-0 fw-bold"><?= $total_barang ?></h2>
                </div>
                <div class="text-primary bg-light p-3 rounded-circle">
                    <i class="fas fa-boxes fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-stat p-3 border-start border-5 border-success h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-muted small fw-bold">Total Masuk</h6>
                    <h2 class="mb-0 fw-bold text-success"><?= $transaksi_masuk ?></h2>
                </div>
                <div class="text-success bg-light p-3 rounded-circle">
                    <i class="fas fa-arrow-down fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-stat p-3 border-start border-5 border-danger h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-muted small fw-bold">Total Keluar</h6>
                    <h2 class="mb-0 fw-bold text-danger"><?= $transaksi_keluar ?></h2>
                </div>
                <div class="text-danger bg-light p-3 rounded-circle">
                    <i class="fas fa-arrow-up fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. TABEL TERPISAH (Kiri: Masuk, Kanan: Keluar) -->
<div class="row">
    
    <!-- KOLOM KIRI: BARANG MASUK (Sudah Diubah ke Keterangan) -->
    <div class="col-lg-6 mb-4">
        <div class="card card-stat h-100">
            <div class="card-header bg-white py-3 border-bottom border-success border-3">
                <h6 class="m-0 fw-bold text-success">
                    <i class="fas fa-arrow-down me-2"></i>Barang Masuk Terakhir
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th>Tgl</th>
                            <th>Barang</th>
                            <th class="text-center">Jml</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($list_masuk)): ?>
                            <tr><td colspan="3" class="text-center py-3 text-muted">Belum ada data</td></tr>
                        <?php else: ?>
                            <?php foreach($list_masuk as $m): ?>
                            <tr>
                                <td class="text-muted"><?= date('d/m', strtotime($m['tanggal'])) ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Gambar Kecil -->
                                        <img src="<?= base_url('images/'.$m['gambar']) ?>" class="rounded-circle me-2 border" width="35" height="35" style="object-fit:cover;" onerror="this.src='https://via.placeholder.com/35'">
                                        <div>
                                            <div class="fw-bold text-dark"><?= $m['nama_barang'] ?></div>
                                            <!-- INI YANG DIUBAH: Menampilkan Keterangan -->
                                            <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                                <?= $m['keterangan'] ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold text-success">+<?= $m['jumlah'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: BARANG KELUAR -->
    <div class="col-lg-6 mb-4">
        <div class="card card-stat h-100">
            <div class="card-header bg-white py-3 border-bottom border-danger border-3">
                <h6 class="m-0 fw-bold text-danger">
                    <i class="fas fa-arrow-up me-2"></i>Barang Keluar Terakhir
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th>Tgl</th>
                            <th>Barang</th>
                            <th class="text-center">Jml</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($list_keluar)): ?>
                            <tr><td colspan="3" class="text-center py-3 text-muted">Belum ada data</td></tr>
                        <?php else: ?>
                            <?php foreach($list_keluar as $k): ?>
                            <tr>
                                <td class="text-muted"><?= date('d/m', strtotime($k['tanggal'])) ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('images/'.$k['gambar']) ?>" class="rounded-circle me-2 border" width="35" height="35" style="object-fit:cover;" onerror="this.src='https://via.placeholder.com/35'">
                                        <div>
                                            <div class="fw-bold text-dark"><?= $k['nama_barang'] ?></div>
                                            <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                                <?= $k['keterangan'] ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold text-danger">-<?= $k['jumlah'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>