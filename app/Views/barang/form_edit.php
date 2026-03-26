<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-stat p-4">
            <div class="d-flex justify-content-between mb-4"><h4>Edit Barang</h4><a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm">Kembali</a></div>
            
            <form action="<?= base_url('barang/update/'.$barang['id_barang']) ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="gambar_lama" value="<?= $barang['gambar'] ?>">
                
                <div class="mb-3 row"><label class="col-sm-3 fw-bold">Kode</label><div class="col-sm-9"><input type="text" name="kode_barang" class="form-control" value="<?= $barang['kode_barang'] ?>" required></div></div>
                <div class="mb-3 row"><label class="col-sm-3 fw-bold">Nama</label><div class="col-sm-9"><input type="text" name="nama_barang" class="form-control" value="<?= $barang['nama_barang'] ?>" required></div></div>
                
                <div class="mb-3 row"><label class="col-sm-3 fw-bold">Kategori</label><div class="col-sm-9">
                    <select name="id_kategori" class="form-select">
                        <?php foreach($kategori as $k): ?>
                        <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori']==$barang['id_kategori']?'selected':'' ?>><?= $k['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>

                <div class="mb-3 row"><label class="col-sm-3 fw-bold">Harga</label><div class="col-sm-9"><input type="number" name="harga" class="form-control" value="<?= $barang['harga'] ?>" required></div></div>
                
                <!-- TAMBAHAN: INPUT STOK MANUAL -->
                <div class="mb-3 row">
                    <label class="col-sm-3 fw-bold">Stok Gudang</label>
                    <div class="col-sm-9">
                        <input type="number" name="stok" class="form-control" value="<?= $barang['stok'] ?>" required>
                        <small class="text-danger">*Edit manual hanya untuk koreksi data (Stock Opname).</small>
                    </div>
                </div>

                <div class="mb-3 row"><label class="col-sm-3 fw-bold">Foto Saat Ini</label><div class="col-sm-9">
                    <img src="<?= base_url('images/'.$barang['gambar']) ?>" width="100" class="rounded border">
                    <small class="d-block text-muted">File: <?= $barang['gambar'] ?></small>
                </div></div>
                
                <div class="mb-3 row"><label class="col-sm-3 fw-bold">Ganti Foto</label><div class="col-sm-9"><input type="file" name="gambar" class="form-control"><small class="text-danger">*Biarkan kosong jika tidak diganti</small></div></div>

                <button type="submit" class="btn btn-tokopedia w-100 fw-bold">SIMPAN PERUBAHAN</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>