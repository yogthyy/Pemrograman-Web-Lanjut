<?php

require_once __DIR__ . '/../../core/Controller.php';

class AuthController extends Controller {

    // Menampilkan halaman login
    public function index() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'index.php?url=account');
            exit;
        }

        $data = [
            'title' => 'Login',
            'error' => '',
            'success' => '',
            'old_email' => $_SESSION['old_email'] ?? ''
        ];
        unset($_SESSION['old_email']);

        if (isset($_SESSION['login_error'])) {
            $data['error'] = $_SESSION['login_error'];
            unset($_SESSION['login_error']);
        }

        if (isset($_SESSION['login_success'])) {
            $data['success'] = $_SESSION['login_success'];
            unset($_SESSION['login_success']);
        }

        $this->viewOnly('auth/login', $data);
    }

    // Menghasilkan gambar captcha sesuai materi captcha.php
    public function captcha() {
        require __DIR__ . '/../../captcha.php';
        exit;
    }

    // Memproses login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?url=auth');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $kodecaptcha = trim($_POST['kodecaptcha'] ?? $_POST['captcha'] ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['old_email'] = $email;
            $_SESSION['login_error'] = 'Email dan password wajib diisi.';
            header('Location: ' . BASE_URL . 'index.php?url=auth');
            exit;
        }

        // Mengecek apakah user menginput captcha dengan benar sesuai materi hasil.php
        if (empty($kodecaptcha) || !isset($_SESSION['code']) || $_SESSION['code'] != $kodecaptcha) {
            unset($_SESSION['code']);
            $_SESSION['old_email'] = $email;
            $_SESSION['login_error'] = 'Kode CAPTCHA anda salah';
            header('Location: ' . BASE_URL . 'index.php?url=auth');
            exit;
        }

        // Reset session captcha setelah berhasil diverifikasi
        unset($_SESSION['code']);

        $accountModel = $this->model('Account');
        $account = $accountModel->findByEmail($email);

        if (!$account) {
            $_SESSION['old_email'] = $email;
            $_SESSION['login_error'] = 'Email atau password salah.';
            header('Location: ' . BASE_URL . 'index.php?url=auth');
            exit;
        }

        // Verifikasi password (bcrypt hash atau plain jika ada)
        $isPasswordValid = false;
        if (password_verify($password, $account['password'])) {
            $isPasswordValid = true;
        } elseif ($password === $account['password']) {
            $isPasswordValid = true;
        }

        if (!$isPasswordValid) {
            $_SESSION['old_email'] = $email;
            $_SESSION['login_error'] = 'Email atau password salah.';
            header('Location: ' . BASE_URL . 'index.php?url=auth');
            exit;
        }

        // Simpan sesi user
        $_SESSION['user_id'] = $account['id'];
        $_SESSION['user_name'] = $account['name'];
        $_SESSION['user_email'] = $account['email'];
        $_SESSION['user_account_type'] = $account['account_type_name'] ?? 'User';

        header('Location: ' . BASE_URL . 'index.php?url=account');
        exit;
    }

    // Menampilkan halaman pendaftaran (Register/Sign-Up)
    public function register() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'index.php?url=account');
            exit;
        }

        $data = [
            'title' => 'Sign-Up',
            'error' => $_SESSION['register_error'] ?? '',
            'validate' => $_SESSION['register_validate'] ?? '',
            'old' => $_SESSION['register_old'] ?? []
        ];

        unset($_SESSION['register_error']);
        unset($_SESSION['register_validate']);
        unset($_SESSION['register_old']);

        $this->viewOnly('auth/register', $data);
    }

    // Memproses form pendaftaran (Sign-Up / Register)
    public function processRegister() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
            exit;
        }

        $name = stripslashes(trim($_POST['name'] ?? ''));
        $email = stripslashes(trim($_POST['email'] ?? ''));
        $username = stripslashes(trim($_POST['username'] ?? ''));
        $password = stripslashes($_POST['password'] ?? '');
        $repass = stripslashes($_POST['repassword'] ?? $_POST['repass'] ?? '');

        // Cek apakah ada nilai input yang kosong
        if (empty($name) || empty($email) || empty($username) || empty($password) || empty($repass)) {
            $_SESSION['register_error'] = 'Data tidak boleh kosong !!';
            $_SESSION['register_old'] = ['name' => $name, 'email' => $email, 'username' => $username];
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
            exit;
        }

        // Mengecek apakah password sama dengan re-password
        if ($password !== $repass) {
            $_SESSION['register_validate'] = 'Password tidak sama !!';
            $_SESSION['register_old'] = ['name' => $name, 'email' => $email, 'username' => $username];
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
            exit;
        }

        // Validasi panjang password minimal
        if (strlen($password) < 6) {
            $_SESSION['register_validate'] = 'Password minimal harus 6 karakter.';
            $_SESSION['register_old'] = ['name' => $name, 'email' => $email, 'username' => $username];
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
            exit;
        }

        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['register_error'] = 'Format email tidak valid.';
            $_SESSION['register_old'] = ['name' => $name, 'email' => $email, 'username' => $username];
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
            exit;
        }

        $accountModel = $this->model('Account');

        // Cek apakah email sudah terdaftar
        if ($accountModel->findByEmail($email)) {
            $_SESSION['register_error'] = 'Email sudah terdaftar !!';
            $_SESSION['register_old'] = ['name' => $name, 'email' => $email, 'username' => $username];
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
            exit;
        }

        // Cek apakah username sudah terdaftar
        if ($accountModel->findByIdentificationNumber($username)) {
            $_SESSION['register_error'] = 'Username sudah terdaftar !!';
            $_SESSION['register_old'] = ['name' => $name, 'email' => $email, 'username' => $username];
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
            exit;
        }

        // Simpan data akun baru ke database
        $created = $accountModel->createAccount([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'identification_number' => $username,
            'identification_type' => 'NIM',
            'status' => 'Aktif',
            'account_type_id' => null
        ]);

        if ($created) {
            $_SESSION['login_success'] = 'Registrasi berhasil! Silakan masuk dengan akun baru Anda.';
            header('Location: ' . BASE_URL . 'index.php?url=auth');
        } else {
            $_SESSION['register_error'] = 'Register User Gagal !!';
            $_SESSION['register_old'] = ['name' => $name, 'email' => $email, 'username' => $username];
            header('Location: ' . BASE_URL . 'index.php?url=auth/register');
        }
        exit;
    }

    // Memproses logout
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_account_type']);
        unset($_SESSION['code']);
        session_destroy();

        header('Location: ' . BASE_URL . 'index.php?url=auth');
        exit;
    }
}
