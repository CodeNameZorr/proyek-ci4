<?php namespace App\Models;
use CodeIgniter\Model;

class TransaksiModel extends Model {
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_barang', 'jenis_transaksi', 'jumlah', 'tanggal', 'keterangan'];

    // Fungsi lama (opsional, biarkan saja)
    public function getTransaksiLengkap() {
        return $this->select('transaksi.*, barang.nama_barang')
                    ->join('barang', 'barang.id_barang = transaksi.id_barang')
                    ->orderBy('tanggal', 'DESC')
                    ->findAll();
    }

    // FUNGSI BARU: Ambil data berdasarkan jenis (Masuk/Keluar)
    // Limit 5 data terbaru
    public function getByJenis($jenis) {
        return $this->select('transaksi.*, barang.nama_barang, barang.gambar, barang.kode_barang')
                    ->join('barang', 'barang.id_barang = transaksi.id_barang')
                    ->where('jenis_transaksi', $jenis)
                    ->orderBy('tanggal', 'DESC')     // Urutkan Tanggal Terbaru
                    ->orderBy('id_transaksi', 'DESC') // Jika tanggal sama, yang input belakangan di atas
                    ->findAll(5); // Ambil 5 saja
    }
}