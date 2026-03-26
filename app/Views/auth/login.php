<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Gudang Percetakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="login-body">

<div class="card card-login p-4 bg-white">
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="fas fa-print fa-3x text-tokopedia"></i>
        </div>
        <h3 class="fw-bold text-tokopedia">GudangPrint</h3>
        <p class="text-muted">Sistem Manajemen Stok</p>
    </div>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger py-2 small text-center rounded-pill">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/login_process') ?>" method="post">
        <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="u" placeholder="Username" required>
            <label for="u">Username</label>
        </div>
        <div class="form-floating mb-4">
            <input type="password" name="password" class="form-control" id="p" placeholder="Password" required>
            <label for="p">Password</label>
        </div>
        <button type="submit" class="btn btn-tokopedia w-100 py-2 rounded-pill fs-5">MASUK</button>
    </form>
    
    <div class="text-center mt-4">
        <small class="text-muted">UAS Web Programming 2</small>
    </div>
</div>

</body>
</html>