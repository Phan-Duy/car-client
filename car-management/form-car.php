<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
# Kiểm tra xem có phải là phương thức post được sumbmit không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   try {
      # Kiểm tra xem user có thêm ảnh không
      if (!empty($_FILES['thumbnail']['tmp_name'])) { # Trường hợp là có
         $pathUpload = "C:\\xampp\htdocs\Web_Car\uploads\\";
         $nameThumnail = uniqid() . ".jpg";
         $path = $pathUpload . $nameThumnail;

         $_POST['thumbnail'] = $nameThumnail;
      }

      # Kiểm tra xem đang là form gì để xử lý query
      if ($option === "add") {
         $query = "INSERT INTO car (id ,name, brand, color, price, yearOfProduction, description, thumbnail) VALUES (:id ,:name, :brand, :color, :price, :yearOfProduction, :description, :thumbnail)";
      } else {
         $query = "UPDATE car SET name=:name, brand=:brand, color=:color, price=:price, yearOfProduction=:yearOfProduction, description=:description" . (!empty($_FILES['thumbnail']['tmp_name']) ? ", thumbnail=:thumbnail" : "") . " WHERE id=:id";
      }
      $params = $_POST;
      $result = $db->query($query, $params);
      # Thông báo thành công / thất bại
      if ($result) {
         if ($option === "add") {
            $message = "Thêm xe mới thành công!";
         } else {
            $message = "Cập nhật xe thành công!";
         }
         $status = 'success';
         # Kiểm tra xem user có thêm ảnh không
         if (!empty($_FILES['thumbnail']['tmp_name'])) {
            if ($option === "update") {
               # Lấy data cũ để lấy tên ảnh
               $query = "SELECT thumbnail FROM car WHERE id = " . (isset($_GET['id']) ? $_GET['id'] : $_POST['id']);
               $data = $db->get($query);
               # Xoá ảnh cũ đi
               $pathOld = $pathUpload . $data['0']['thumbnail'];
               if (file_exists($pathOld)) {
                  unlink($pathOld);
               }
            }
            # thêm ảnh vào folder upload của server
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);
         }
      } else {
         $message = "Lỗi khi đang xử lý dữ liệu!";
         $status = 'danger';
      }
   } catch (Exception $exception) {
      $message = "Lỗi khi đang xử lý dữ liệu!";
      $status = 'danger';
   }
}

# Nếu form là update thì lấy dữ liệu để hiện lên form
if ($option === "update") {
   $query = "SELECT * FROM car WHERE id = " . (isset($_GET['id']) ? $_GET['id'] : $_POST['id']);
   $data = $db->get($query);
}

?>

<div class="container">
   <h1 class="text-center mt-3"><?= $option === "add" ? "Thêm thông tin xe" : "Sửa thông tin xe" ?></h1>
   <hr>
   <div class="d-flex align-items-center justify-content-center">
      <?php if (isset($message)) : ?>
         <div class="alert alert-<?= $status ?> d-inline-block" role="alert">
            <?= $message ?>
         </div>
      <?php endif; ?>
   </div>
   <form action="./form-car.php<?= $option === "update" ? "?id=" . $data['0']['id'] : '' ?>" method="post" enctype="multipart/form-data">
      <input type="number" name="id" hidden value="<?= $option === "update" ? $data['0']['id'] : "0" ?>">
      <div class="form-floating mb-3">
         <input type="text" class="form-control" id="nameCar" required name="name" placeholder="Tên xe" value="<?= $option === "update" ? $data['0']['name'] : "" ?>">
         <label for="nameCar">Tên xe</label>
      </div>

      <div class="row">
         <div class="form-floating mb-3 col-6">
            <input type="text" class="form-control" id="brands" required name="brand" placeholder="Hãng sản xuất" value="<?= $option === "update" ? $data['0']['brand'] : "" ?>">
            <label class="ms-2" for="brands">Hãng sản xuất</label>
         </div>
         <div class="form-floating mb-3 col-6">
            <input type="number" class="form-control" id="yearOfProduction" required name="yearOfProduction" placeholder="Năm sản xuất" value="<?= $option === "update" ? $data['0']['yearOfProduction'] : "" ?>">
            <label class="ms-2" for="yearOfProduction">Năm sản xuất</label>
         </div>
         <div class="form-floating mb-3 col-6">
            <input type="text" class="form-control" id="color" required name="color" placeholder="Màu sắc" value="<?= $option === "update" ? $data['0']['color'] : "" ?>">
            <label class="ms-2" for="color">Màu sắc</label>
         </div>
         <div class="form-floating mb-3 col-6">
            <input type="number" min="1" class="form-control" id="price" required name="price" placeholder="Giá bán" value="<?= $option === "update" ? $data['0']['price'] : "" ?>">
            <label class="ms-2" for="price">Giá bán</label>
         </div>
      </div>
      <div class="form-floating mb-3">
         <textarea type="text" class="form-control" id="description" placeholder="Mô tả" required name="description" style="height: 100px"><?= $option === "update" ? $data['0']['description'] : "" ?></textarea>
         <label for="description">Mô tả</label>
      </div>
      <span class="mb-2">Thêm ảnh thumnail: </span>
      <div class="input-group mb-3">
         <input type="file" id="avatar" name="thumbnail" <?= $option === "add" ? "required" : "" ?> class="form-control" name="avatar" accept="image/png, image/jpeg" />
      </div>
      <?php if ($option === "update") : ?>
         <img src="../uploads/<?= $data['0']['thumbnail'] ?>" alt="" width="200">
      <?php endif; ?>
      <div class="d-flex align-items-center justify-content-end">
         <a href="./list-car.php" class="btn btn-secondary me-3">Quay về</a>
         <button type="submit" class="btn btn-primary"><?= $option === "add" ? "Thêm" : "Lưu" ?></button>
      </div>
   </form>
</div>

