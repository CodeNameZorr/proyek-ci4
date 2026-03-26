<?php namespace App\Controllers;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class Barang extends BaseController {

    public function index() {
        if (!session()->get('logged_in')) return redirect()->to(base_url('/'));
        
        $barangModel = new BarangModel();
        $kategoriModel = new KategoriModel();

        // 1. TANGKAP KEYWORD DARI NAVBAR
        $keyword = $this->request->getGet('keyword');

        $data = [
            'title' => 'Data Barang',
            // 2. Kirim keyword ke Model
            'barang' => $barangModel->getBarangLengkap($keyword), 
            'kategori' => $kategoriModel->findAll(),
            // 3. Kirim balik keyword ke View biar tulisan di kotak gak ilang
            'keyword' => $keyword 
        ];
        return view('barang/index', $data);
    }

    public function tambah() {
        $model = new BarangModel();
        $fileGambar = $this->request->getFile('gambar');
        
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'default.jpg';
        } else {
            // Pakai Random Name biar aman dari cache browser
            $namaGambar = $fileGambar->getRandomName(); 
            $fileGambar->move('images', $namaGambar);
        }

        $model->save([
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => 0,
            'gambar'      => $namaGambar
        ]);
        return redirect()->to(base_url('barang'));
    }

    public function edit($id) {
        if (!session()->get('logged_in')) return redirect()->to(base_url('/'));
        
        $barangModel = new BarangModel();
        $kategoriModel = new KategoriModel();

        return view('barang/form_edit', [
            'title' => 'Edit Barang',
            'barang' => $barangModel->find($id),
            'kategori' => $kategoriModel->findAll()
        ]);
    }

    // --- BAGIAN INI YANG PENTING UNTUK GAMBAR ---
    public function update($id) {
        $model = new BarangModel();
        $barangLama = $model->find($id);
        $fileGambar = $this->request->getFile('gambar');
        
        // 1. Cek apakah user upload gambar baru?
        if ($fileGambar->getError() == 4) {
            // Tidak upload -> Pakai nama gambar lama
            $namaGambar = $this->request->getPost('gambar_lama');
        } else {
            // Upload baru -> Generate nama baru
            $namaGambar = $fileGambar->getName();
            $fileGambar->move('images', $namaGambar);
            
            // 2. HAPUS GAMBAR LAMA (Unlink)
            // Syarat: Gambar lama bukan 'default.jpg' DAN filenya ada di folder
            if ($barangLama['gambar'] != 'default.jpg' && file_exists('images/' . $barangLama['gambar'])) {
                unlink('images/' . $barangLama['gambar']); 
            }
        }

        // 3. Simpan data baru
        $model->save([
            'id_barang'   => $id,
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'), // Update stok manual
            'gambar'      => $namaGambar
        ]);
        return redirect()->to(base_url('barang'));
    }

    public function hapus($id) {
        $model = new BarangModel();
        $barang = $model->find($id);
        
        // Hapus file saat data dihapus
        if ($barang['gambar'] != 'default.jpg' && file_exists('images/' . $barang['gambar'])) {
            unlink('images/' . $barang['gambar']);
        }

        $model->delete($id);
        return redirect()->to(base_url('barang'));
    }
}