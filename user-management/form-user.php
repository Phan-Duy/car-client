<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<?php
session_start();
# Kiểm tra xem có phải là role admin không, nếu không thì không cho vào trang này
if ((!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
   header("Location: ../index.php");
}

include_once "../database/db_connect.php";
$db = new DB_Connect();
# Biến để nhận biết xem form này hiện tại là đang thêm hay chỉnh sửa
$option = isset($_GET['id']) ? 'update' : 'add';

$data = null;
$isCheckUsername = null;

# Kiểm tra xem có phải là phương thức post được sumbmit không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   try {
      if ($option === "add") {
         # kiểm tra username xem đã tồn tại chưa
         $isCheckUsername = (bool) $db->get("SELECT * FROM user WHERE username=:username", ['username' => $_POST['username']]);
      } else {
         $user = $db->get("SELECT * FROM user WHERE username=:username", ['username' => $_POST['username']]);
      }
      if (!$isCheckUsername) {
         # Kiểm tra xem đang là form gì để xử lý query
         if ($option === "add") {
            $query = "INSERT INTO user (id, username, password, fullName, address, email, birthDay, role) VALUES (:id, :username,:password,:fullName,:address,:email,:birthDay,:role)";
         } else {
            $query = "UPDATE user SET username=:username, password=:password, fullName=:fullName, address=:address, email=:email, birthDay=:birthDay, role=:role" . " WHERE id=:id";
         }
         $params = $_POST;
         # mã hoá mật khẩu
         if (empty($_POST['password'])) {
            $params['password'] = $user['0']['password'];
         } else {
            $params['password'] = password_hash($_POST['password'], null);
         }
         $result = $db->query($query, $params);
         # Thông báo thành công / thất bại
         if ($result) {
            if ($option === "add") {
               $message = "Thêm khách hàng thành công!";
            } else {
               $message = "Cập nhật khách hàng thành công!";
            }
            # Để css ở dưới
            $status = 'success';
         } else {
            $message = "Lỗi khi đang xử lý dữ liệu!";
            $status = 'danger';
         }
      } else {
         # Nếu tồn tại username rồi thì thông bái lỗi
         $message = "Tên tài khoản đã tồn tại!!!";
         $status = 'danger';
      }
   } catch (Exception $exception) {
      $message = "Lỗi khi đang xử lý dữ liệu!";
      $status = 'danger';
   }
}

# Nếu form là update thì lấy dữ liệu để hiện lên form
if ($option === "update") {
   $query = "SELECT * FROM user WHERE id = " . (isset($_GET['id']) ? $_GET['id'] : $_POST['id']);
   $data = $db->get($query);
}

?>

<div class="container">
   <h1 class="text-center mt-3"><?= $option === "add" ? "Thêm thông tin khách hàng" : "Sửa thông tin khách hàng" ?></h1>
   <hr>
   <div class="d-flex align-items-center justify-content-center">
      <?php if (isset($message)) : ?>
         <div class="alert alert-<?= $status ?> d-inline-block" role="alert">
            <?= $message ?>
         </div>
      <?php endif; ?>
   </div>
   <form action="./form-user.php<?= $option === "update" ? "?id=" . $data['0']['id'] : '' ?>" method="post">
      <input type="number" name="id" hidden value="<?= $option === "update" ? $data['0']['id'] : "0" ?>">
      <div class="row">
         <div class="form-floating mb-3 col-6">
            <input <?= $option === "update" ? 'readonly' : '' ?> type="text" class="form-control" id="username" required name="username" placeholder="Tên tài khoản" value="<?= $option === "update" ? $data['0']['username'] : "" ?>">

            <label class="ms-2" for="username">Tên tài khoản</label>
         </div>
         <div class="form-floating mb-3 col-6 d-flex">
               <input <?= $option === "update" ? '' : 'required' ?> type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
               <label class="ms-2" for="password">Mật khẩu</label>
               <i class="far fa-eye-slash position-absolute top-50 end-0 translate-middle-y" id="togglePassword" style="cursor: pointer; margin-right: 20px;"></i>
         </div>
         <div class="form-floating mb-3 col-6">
            <input type="text" class="form-control" id="fullName" required name="fullName" placeholder="Họ và tên" value="<?= $option === "update" ? $data['0']['fullName'] : "" ?>">
            <label class="ms-2" for="fullName">Họ và tên</label>
         </div>
         <div class="form-floating mb-3 col-6">
            <input type="text" class="form-control" id="address" required name="address" placeholder="Địa chỉ" value="<?= $option === "update" ? $data['0']['address'] : "" ?>">
            <label class="ms-2" for="address">Địa chỉ</label>
         </div>
         <div class="form-floating mb-3 col-6">
            <input type="email" class="form-control" id="email" required name="email" placeholder="Email" value="<?= $option === "update" ? $data['0']['email'] : "" ?>">
            <label class="ms-2" for="email">Email</label>
         </div>
         <div class="form-floating mb-3 col-6">
            <input type="date" min="1" class="form-control" id="birthDay" required name="birthDay" placeholder="Ngày sinh" value="<?= $option === "update" ? $data['0']['birthDay'] : "" ?>">
            <label class="ms-2" for="birthDay">Ngày sinh</label>
         </div>
      </div>
      <div class="form-floating mb-3">
         <select class="form-select" id="role" name="role" aria-label="Floating label select example">
            <option value="customer" <?= ($option === "update" && $data[0]['role'] === "customer") ? 'selected' : '' ?>>
               Customer</option>
            <option value="admin" <?= ($option === "update" && $data[0]['role'] === "admin") ? 'selected' : '' ?>>Admin
            </option>
         </select>
         <label for="role">Chọn quyền</label>
      </div>

      <div class="d-flex align-items-center justify-content-end">
         <a href="./list-user.php" class="btn btn-secondary me-3">Quay về</a>
         <button type="submit" class="btn btn-primary"><?= $option === "add" ? "Thêm" : "Lưu" ?></button>
      </div>
   </form>
</div>

<script>
   document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
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