<?php include_once "./layout/header.php";
include_once "./database/db_connect.php";
$db = new DB_Connect();
$datas = $db->get("SELECT * FROM car LIMIT 3");
?>

<div id="outer2">
   <div id="left-nav">
      <h2>Vehicle Showcase</h2>
      <?php foreach ($datas as $data) : ?>
         <div id="showcase">
            <div class="stxt-bg">
               <h3><?= $data['name'] ?></h3>
               <div class="smalltext">
                  <a href="#"><img src="./uploads/<?= $data['thumbnail'] ?>" alt="" width="150" height="95"></a>
                  <div class="clear"></div>
                  <?= $data['description'] ?>
                  <div style="clear: right; height: 25px;">
                     <span class="read-more"><a href="#">Read More</a></span>
                  </div>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</div>

<div id="content">
   <h2>Welcome to our website!</h2>
   <div id="main">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore vel fugit minus totam. Ullam quos maxime
      architecto consequatur incidunt qui voluptates molestias voluptatibus, deleniti odit, sint non temporibus aut
      placeat! Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum officia, suscipit, consectetur
      placeat dolore distinctio atque deserunt in numquam maiores repellendus reiciendis quisquam corporis eos.
      Labore itaque odit rerum at.
      <h4>New Feature Car</h4>
      <a href="#"><img src="https://thuonghieuvaphapluat.vn/Images/tanbt/2018/12/08/2011-lamborghini-gallardo.jpg" alt="" width="150" height="95"></a>
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium non quisquam eaque commodi ipsam laborum
      perspiciatis minus Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi sit ut optio nemo ipsum
      nesciunt, nobis corporis! Blanditiis, molestiae explicabo. Dolore reprehenderit dolorem minima nostrum incidunt
      eius accusantium nam optio. <span class="read-more"><a href="#">Read More</a></span>
      <div class="clear"></div>

      <h4>New Feature Car</h4>
      <a href="#"><img src="https://cdn-ds.com/blogs-media/sites/61/2023/07/24233105/Jul23_Blog01_LamborghiniAustin_a_o_Gallardo_side.jpg" alt="" width="150" height="95"></a>
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium non quisquam eaque commodi ipsam laborum
      perspiciatis minus Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos saepe incidunt accusantium,
      commodi, hic soluta natus error quis a enim voluptate ex laudantium mollitia rerum! Quo quas nesciunt animi.
      Aspernatur. <span class="read-more"><a href="#">Read More</a></span>
      <div class="clear"></div>

      <h2>Company New</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo impedit quas cupiditate, modi illo
         corrupti aliquam enim est fugit rem officiis dolores facere? Sit, totam nobis assumenda sunt neque ea. Lorem
         ipsum dolor sit, amet consectetur adipisicing elit. Atque deserunt nulla rerum omnis quibusdam quo iure
         veritatis, molestias possimus perspiciatis adipisci facere neque quae magnam est assumenda aperiam, tempore
         a. <span class="read-more"><a href="#">Read More</a></span></p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem sunt blanditiis dolorem nam dignissimos?
         Vero, sequi sit facilis quaerat aliquid vitae nostrum rem nulla maiores voluptatem sed repudiandae quo
         corrupti? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate, nulla consequuntur impedit
         ducimus veritatis id vero hic, minima odit modi reiciendis officia quam libero vitae maiores saepe voluptate
         aut laudantium. <span class="read-more"><a href="#">Read More</a></span></p>
   </div>
   <div class="clear"></div>
</div>

<?php include_once "./layout/footer.php"; ?>

</body>

</html>