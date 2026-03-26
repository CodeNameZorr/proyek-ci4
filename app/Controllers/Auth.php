<?php namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController {
    
    public function index() {
        if (session()->get('logged_in')) return redirect()->to(base_url('dashboard'));
        return view('auth/login');
    }

    public function login_process() {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $user = $model->where('username', $username)->first();

        if ($user) {
            // LOGIKA BYPASS SIMPLE:
            // Admin -> pass: admin123
            // Staff -> pass: user123
            $isAdmin = ($username == 'admin' && $password == 'admin123');
            $isStaff = ($username == 'staff' && $password == 'user123');

            if ($isAdmin || $isStaff) {
                session()->set([
                    'id' => $user['id'], 
                    'nama' => $user['nama_lengkap'], 
                    'role' => $user['role'], 
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('dashboard'));
            }
        }
        
        session()->setFlashdata('error', 'Username atau Password salah!');
        return redirect()->to(base_url('/'));
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}