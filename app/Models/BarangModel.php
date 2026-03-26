<?php namespace App\Models;
use CodeIgniter\Model;

class BarangModel extends Model {
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['kode_barang', 'nama_barang', 'id_kategori', 'harga', 'stok', 'gambar'];

    // UPDATE: Tambahkan parameter $keyword = null
    public function getBarangLengkap($keyword = null) {
        $builder = $this->select('barang.*, kategori.nama_kategori')
                        ->join('kategori', 'kategori.id_kategori = barang.id_kategori');
        
        // Jika ada keyword pencarian
        if ($keyword) {
            $builder->groupStart()
                    ->like('nama_barang', $keyword)
                    ->orLike('kode_barang', $keyword)
                    ->groupEnd();
        }

        return $builder->findAll();
    }
}