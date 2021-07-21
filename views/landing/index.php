<header>
<?php
  require_once 'views/common/header.php';
?>
</header>
<div>
  <main>
      <div>
          <div>
            <ul class="listcategory">
              <li id="moinhat">Moi nhat</li>
              <li id="khoahoc">Khoa hoc</li>
              <li id="giaitri">Giai tri</li>
              <li id="noibat">Noi Bat</li>
            </ul>
          </div>
          <?php require_once 'views/questions/list.php'; ?>
      </div>
      <aside>
          <div>
          </div>
      </aside>
  </main>
</div>
