<?php
// Rute langsung ke halaman login
require_once __DIR__ . '/config/app.php';
header('Location: ' . BASE_URL . 'index.php?url=auth');
exit;
