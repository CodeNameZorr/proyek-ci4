<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Header Seragam -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark">Data Barang</h3>
        <p class="text-muted mb-0">Kelola stok dan item barang di sini.</p>
    </div>
    <button class="btn btn-tokopedia shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="fas fa-plus me-2"></i>Tambah Barang
    </button>
</div>

<!-- Tabel Seragam -->
<div class="card card-stat overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Foto</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($barang as $b): ?>
                <tr>
                    <td class="ps-4">
                        <img src="<?= base_url('images/'.$b['gambar']) ?>" width="45" height="45" class="rounded border" style="object-fit: cover;" onerror="this.src='https://via.placeholder.com/45?text=IMG'">
                    </td>
                    <td><span class="badge bg-secondary font-monospace"><?= $b['kode_barang'] ?></span></td>
                    <td class="fw-bold"><?= $b['nama_barang'] ?></td>
                    <td><span class="badge bg-light text-dark border"><?= $b['nama_kategori'] ?></span></td>
                    <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
                    <td>
                        <?php if($b['stok'] < 10): ?>
                            <span class="text-danger fw-bold"><i class="fas fa-exclamation-circle me-1"></i><?= $b['stok'] ?></span>
                        <?php else: ?>
                            <span class="text-success fw-bold"><?= $b['stok'] ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-4">
                        <a href="<?= base_url('barang/edit/'.$b['id_barang']) ?>" class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i></a>
                        <a href="<?= base_url('barang/hapus/'.$b['id_barang']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus item ini?')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah (Desain Seragam) -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= base_url('barang/tambah') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header bg-tokopedia">
                <h5 class="modal-title fw-bold">Tambah Barang Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label class="fw-bold">Kode Barang</label><input type="text" name="kode_barang" class="form-control" required></div>
                <div class="mb-3"><label class="fw-bold">Nama Barang</label><input type="text" name="nama_barang" class="form-control" required></div>
                <div class="mb-3"><label class="fw-bold">Kategori</label>
                    <select name="id_kategori" class="form-select">
                        <?php foreach($kategori as $k) echo "<option value='{$k['id_kategori']}'>{$k['nama_kategori']}</option>"; ?>
                    </select>
                </div>
                <div class="mb-3"><label class="fw-bold">Harga</label><input type="number" name="harga" class="form-control" required></div>
                <div class="mb-3"><label class="fw-bold">Foto Produk</label><input type="file" name="gambar" class="form-control" accept="image/*"></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-tokopedia w-100">Simpan Data</button></div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>