<?php
session_start();
# Kiểm tra xem có phải là role admin không, nếu không thì không cho vào trang này
if ((!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
   header("Location: ../index.php");
}

include "../database/db_connect.php";
$db = new DB_Connect();
if (isset($_GET['id'])) {
   $query = "DELETE FROM user WHERE id = :id";
   $params = [
      "id" => $_GET['id'],
   ];
   $db->query($query, $params);
   header("Location: list-user.php");
   exit();
} else {
   echo "xoá thất bại";
}