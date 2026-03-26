<?php namespace App\Controllers;
use App\Models\BarangModel;
use App\Models\TransaksiModel;

class Dashboard extends BaseController {
    
    public function index() {
        if (!session()->get('logged_in')) return redirect()->to(base_url('/'));

        $barangModel = new BarangModel();
        $transaksiModel = new TransaksiModel();

        $data = [
            'title' => 'Dashboard',
            // Statistik Angka
            'total_barang' => $barangModel->countAll(),
            'transaksi_masuk' => $transaksiModel->where('jenis_transaksi', 'masuk')->countAllResults(),
            'transaksi_keluar' => $transaksiModel->where('jenis_transaksi', 'keluar')->countAllResults(),
            
            // Data Tabel (DIPISAH)
            'list_masuk' => $transaksiModel->getByJenis('masuk'),
            'list_keluar' => $transaksiModel->getByJenis('keluar')
        ];

        return view('dashboard/index', $data);
    }
}