<?php
// Rute langsung ke halaman pendaftaran (register)
require_once __DIR__ . '/config/app.php';
header('Location: ' . BASE_URL . 'index.php?url=auth/register');
exit;
