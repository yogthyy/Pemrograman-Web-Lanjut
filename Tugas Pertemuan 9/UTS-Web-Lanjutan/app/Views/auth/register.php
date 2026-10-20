<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Daftar') ?> - <?= APP_NAME ?></title>
    <!-- CSS Bootstrap 5 -->
    <link rel="stylesheet" href="<?= BASE_URL ?>bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="card shadow-sm border-0" style="width: 100%; max-width: 480px;">
        <div class="card-body p-4 p-md-5">
            <!-- Header Card -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-3 mb-3 p-3 shadow-sm">
                    <i class="bi bi-person-plus fs-2"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Daftar</h4>
                <p class="text-muted small">Pendaftaran akun pengguna baru</p>
            </div>

            <!-- Notifikasi Pesan Error -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger py-2 px-3 small text-center mb-3" role="alert">
                    <i class="bi bi-exclamation-circle me-1"></i><?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Form Register -->
            <form action="<?= BASE_URL ?>index.php?url=auth/processRegister" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="name" class="form-label small fw-bold text-secondary">Nama</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control" 
                        placeholder="Masukkan Nama"
                        value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                        required 
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Masukkan email"
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label small fw-bold text-secondary">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-control" 
                        placeholder="Masukkan username"
                        value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small fw-bold text-secondary">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Password (minimal 6 karakter)"
                        minlength="6"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="repassword" class="form-label small fw-bold text-secondary">Re-Password</label>
                    <input 
                        type="password" 
                        id="repassword" 
                        name="repassword" 
                        class="form-control <?= !empty($validate) ? 'is-invalid' : '' ?>" 
                        placeholder="Ulangi Password"
                        minlength="6"
                        required
                    >
                    <?php if (!empty($validate)): ?>
                        <div class="text-danger small mt-1">
                            <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($validate) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-check2-circle"></i>
                    <span>Register</span>
                </button>

                <!-- Tautan Kembali ke Login -->
                <div class="form-footer mt-3 text-center">
                    <p class="text-muted small mb-0">
                        Sudah punya akun? <a href="<?= BASE_URL ?>index.php?url=auth" class="text-primary fw-bold text-decoration-none ms-1">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="<?= BASE_URL ?>bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>