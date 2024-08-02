<?php
session_start();
# Kiểm tra xem có phải là role admin không, nếu không thì không cho vào trang này
if ((!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
   header("Location: ../index.php");
}

include "../database/db_connect.php";
$db = new DB_Connect();
if (isset($_GET['id'])) {
   # Lấy data cũ để lấy tên ảnh
   $query = "SELECT thumbnail FROM car WHERE id = " . $_GET['id'];
   $data = $db->get($query);
   # Xoá ảnh cũ đi
   $pathUpload = "C:\\xampp\htdocs\Web_Car\uploads\\";
   $pathOld = $pathUpload . $data['0']['thumbnail'];
   if (file_exists($pathOld)) {
      unlink($pathOld);
   }

   $query = "DELETE FROM car WHERE id = :id";
   $params = [
      "id" => $_GET['id'],
   ];
   $db->query($query, $params);
   header("Location: list-car.php");
   exit();
} else {
   echo "xoá thất bại";
}
