<?php namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\BarangModel;

class Transaksi extends BaseController {

    public function index() {
        return redirect()->to(base_url('dashboard'));
    }

    public function proses() {
        $transaksiModel = new TransaksiModel();
        $barangModel = new BarangModel();

        $id_barang = $this->request->getPost('id_barang');
        $jenis = $this->request->getPost('jenis_transaksi');
        $jumlah = (int)$this->request->getPost('jumlah');

        // Simpan Transaksi
        $transaksiModel->save([
            'id_barang' => $id_barang,
            'jenis_transaksi' => $jenis,
            'jumlah' => $jumlah,
            'tanggal' => $this->request->getPost('tanggal'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        // Update Stok
        $barang = $barangModel->find($id_barang);
        $stok_baru = ($jenis == 'masuk') ? ($barang['stok'] + $jumlah) : ($barang['stok'] - $jumlah);
        if ($stok_baru < 0) $stok_baru = 0;

        $barangModel->update($id_barang, ['stok' => $stok_baru]);

        return redirect()->to(base_url('dashboard'));
    }
}