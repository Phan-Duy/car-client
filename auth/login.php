<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<style>
   body{
      background-image: url("https://scr.vn/wp-content/uploads/2020/07/%E1%BA%A2nh-si%C3%AAu-xe-Lamborghini-%C4%91%E1%BA%B9p-scaled-2048x1152.jpg");
      background-repeat:no-repeat;
      background-size: cover;
      z-index: 10;
   }

</style>

<?php
session_start();
include_once "../database/db_connect.php";
# Nếu đã login rồi thì không được vào trang này nữa
if (isset($_SESSION['is_login'])) {
   header("Location: ../index.php");
}
$db = new DB_Connect();
# Kiểm tra xem submit có phải là method POST không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   # Lấy thông tin user ra bằng username đã nhập
   $user = $db->get_1("SELECT * FROM user WHERE username = :username", ['username' => $_POST['username']]);
   # Kiểm tra xem tồn tại user đó không
   if ((boolval($user))) {
      # Kiểm tra mật khẩu
      if (password_verify($_POST['password'], $user['password'])) {
         # Lưu vào session
         $_SESSION['is_login'] = true;
         $_SESSION['role'] = $user['role'];
         $_SESSION['user'] = $user;
         # Chuyển trang nếu thành công
         header("Location: ../index.php");
         exit();
      }
   }
   # Nếu thất bại thì thông báo ra
   $message = "Tài khoản hoặc mật khẩu không đúng";
   $status = 'danger';
}
?>

<div class="container">
   <div class="row mt-5 ">
      <h1 class="text-center text-white">Đăng nhập</h1>
      <a href="../index.php" class="d-inline-flex align-items-center justify-content-start text-decoration-none mb-3">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
               d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
         </svg>
         <span class="ms-3"> Quay về trang chủ</span>
      </a>
      <hr>
      <?php if (isset($message)) : ?>
      <div class="alert alert-<?= $status ?> d-inline-block" role="alert">
         <?= $message ?>
      </div>
      <?php endif; ?>
      <div class="col-4" style="margin: 20px auto;">
         <form action="" method="post">
            <div class="form-floating mb-3">
               <input type="text" class="form-control" id="floatingInput" name="username" placeholder="" required>
               <label for="floatingInput text-white">Tài khoản</label>
            </div>
            <div class="form-floating">
               <input type="password" class="form-control" id="floatingPassword" name="password" placeholder=""
                  required>
               <label for="floatingPassword">Mật khẩu</label>
            </div>
            <span class="d-block text-end mt-3 text-black">Bạn chưa có tài khoản? <a href="./register.php"
                  class="text-decoration-none fw-bold">Đăng
                  ký</a></span>
            <button class="btn btn-primary w-100 mt-3">Đăng nhập</button>
         </form>
      </div>
   </div>
</div>