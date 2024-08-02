<?php
session_start();

# Khi đăng xuất thì huỷ tất cả dữ liệu có trong phiên đăng nhập (session) trước đó
$_SESSION = array();

session_destroy();

header("Location: ../auth/login.php");
exit();
