<?php
session_start();
# Kiểm tra xem có phải là role admin không, nếu không thì không cho vào trang này
if ((!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
   header("Location: ../index.php");
}

include_once "../database/db_connect.php";
$db = new DB_Connect();
# Lấy tất cả dữ liệu car lên
$datas = $db->get("SELECT * FROM car");

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<style>
   body {
      background-image: url("https://i.redd.it/b3trop02a1p51.png");
      background-repeat: no-repeat;
      background-size: cover;
      margin-bottom: 100px;
   }
</style>
<div class="container">
   <h1 class="text-center mt-3">Danh sách xe</h1>
   <a href="../index.php" class="d-inline-flex align-items-center justify-content-center text-decoration-none">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
      </svg>
      <span class="ms-3"> Quay về trang chủ</span>
   </a>
   <hr>
   <div class=" align-items-center mb-5">
      <a href="./list-car.php" class="btn btn-primary me-3 mb-1">Quản lý xe</a>
      <a href="../user-management/list-user.php" class="btn btn-secondary mb-1">Quản lý khách hàng</a>
      <a href="./form-car.php" class="btn btn-success my-4 d-inline-flex align-items-center justify-content-center float-end mt-4">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
         </svg>
         <span class="ms-2">Thêm xe</span></a>
   </div>
   <table id="table1" class="table table-hover pt-2">
      <thead class="table-dark">
         <tr>
            <th>ID</th>
            <th>ẢNH</th>
            <th>TÊN XE</th>
            <th>THƯƠNG HIỆU</th>
            <th>MÀU</th>
            <th>GIÁ</th>
            <th>NĂM SX</th>
            <th>MÔ TẢ</th>
            <th>HÀNH ĐỘNG</th>
         </tr>
      </thead>
      <?php if (!empty($datas)) : ?>
         <tbody>
            <?php foreach ($datas as $data) : ?>
               <tr>
                  <td><?= $data['id'] ?></td>
                  <td><img src="../uploads/<?= $data['thumbnail'] ?>" alt="" width="200" height="100" style="object-fit: cover;"></td>
                  <td><?= $data['name'] ?></td>
                  <td><?= $data['brand'] ?></td>
                  <td><?= $data['color'] ?></td>
                  <td><?= number_format($data['price'], 0, '', ',') ?></td>
                  <td><?= $data['yearOfProduction'] ?></td>
                  <td><?= $data['description'] ?></td>
                  <td>
                     <div class="d-flex align-items-center justify-content-center">
                        <a href="./form-car.php?id=<?= $data['id'] ?>" class="btn btn-primary me-3">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                              <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                           </svg>
                        </a>

                        <button class="btn btn-danger" onclick="handleDeleteConfirm(<?= $data['id'] ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                           </svg></button>
                     </div>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      <?php endif; ?>
   </table>

</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
   $(document).ready(function() {
      $('#table1').DataTable();
   });

   function handleDeleteConfirm(id) {
      const href = "./handle-delete-car.php?id=" + id;
      const isDeleted = confirm(`Bạn có muốn xoá xe có id là ${id} không?`);
      if (isDeleted) {
         window.location.href = href;
      }
   }
</script>

