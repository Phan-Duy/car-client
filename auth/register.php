<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
$db = new DB_Connect();

# Nếu đã login rồi thì không được vào trang này nữa
if (isset($_SESSION['is_login'])) {
   header("Location: ../index.php");
}

$isCheckUsername = null;

# Kiểm tra xem submit có phải là method POST không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   # kiểm tra username xem đã tồn tại chưa
   $isCheckUsername = (bool) $db->get("SELECT * FROM user WHERE username=:username", ['username' => $_POST['username']]);
   # Nếu không tồn tại thì xử lý
   if (!$isCheckUsername) {
      # các câu lệnh query để thực hiện thêm user
      $query = "INSERT INTO user (username, password, fullName, address, email, birthDay, role) values (:username, :password, :fullName, :address, :email, :birthDay, :role)";
      $params = $_POST;
      # mã hoá mật khẩu
      $params['password'] = password_hash($_POST['password'], null);
      # role mặc định
      $params['role'] = 'customer';
      $result = $db->query($query, $params);
      if ($result) {
         $message = "Đăng ký thành công!";
         $status = 'success';
      } else {
         $message = "Đăng ký thất bại!";
         $status = 'danger';
      }
   } else {
      # Nếu tồn tại username rồi thì thông bái lỗi
      $message = "Đăng ký thất bại!!!";
      $status = 'danger';
   }
}
?>

<div class="container">
   <div class="row mt-5">
      <h1 class="text-center text-white">Đăng ký tài khoản</h1>
      <a href="../index.php" class="d-inline-flex align-items-center justify-content-start text-decoration-none mb-3">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
               d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
         </svg>
         <span class="ms-3"> Quay về trang chủ</span>
      </a>
      <hr>
      <div class="d-flex align-items-center justify-content-center">
         <?php if (isset($message)) : ?>
         <div class="alert alert-<?= $status ?> d-inline-block" role="alert">
            <?= $message ?>
         </div>
         <?php endif; ?>
      </div>
      <div class="col-8" style="margin: 20px 450px;">
         <form action="" method="post">
            <div class="column">
               <div class="col-6">
                  <div class="form-floating mb-3">
                     <input type="text" class="form-control" id="floatingInput" name="username" placeholder="" required>
                     <label for="floatingInput">Tài khoản</label>
                     <p class="text-danger fst-italic">
                        <?= $isCheckUsername ? 'Tài khoản đã tồn tại' : '' ?>
                     </p>
                  </div>
                  <div class="form-floating mb-3">
                     <input type="password" class="form-control" id="floatingPassword" name="password" placeholder=""
                        required>
                     <label for="floatingPassword">Mật khẩu</label>
                     <i class="far fa-eye-slash position-absolute top-50 end-0 translate-middle-y" id="togglePassword" style="cursor: pointer; margin-right: 20px;"></i>
                  </div>
                  <div class="form-floating mb-3">
                     <input type="email" class="form-control" id="floatingPassword" name="email" placeholder=""
                        required>
                     <label for="floatingPassword">Email</label>
                  </div>
                  <div class="form-floating mb-3">
                     <input type="text" class="form-control" id="floatingInput" name="fullName" placeholder="" required>
                     <label for="floatingInput">Họ và tên</label>
                  </div>
                  <div class="form-floating mb-3">
                     <input type="text" class="form-control" id="floatingPassword" name="address" placeholder=""
                        required>
                     <label for="floatingPassword">Địa chỉ</label>
                  </div>
                  <div class="form-floating mb-3">
                     <input type="date" class="form-control" id="floatingPassword" name="birthDay" placeholder=""
                        required>
                     <label for="floatingPassword">Ngày sinh</label>
                  </div>
               </div>
               <div class="col-6">
                  
               </div>
            </div>

            <span class="d-block text-center mt-2 text-white" style="margin-right: 250px;">Bạn có tài khoản rồi? <a href="./login.php"
                  class="text-decoration-none fw-bold">Đăng
                  nhập</a></span>
            <button class="btn btn-primary w-50 mt-3">Đăng ký</button>
         </form>
      </div>
   </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('floatingPassword');
        const fieldType = passwordField.getAttribute('type');
        
        if (fieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        } else {
            passwordField.setAttribute('type', 'password');
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        }
    });
</script>
