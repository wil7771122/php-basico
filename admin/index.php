<?php ob_start();?>
<?php include "includes/admin_header.php"?>
<?php
  if(!isset($_SESSION['user_role'])){
    header("Location: ../index.php");
  }
?>
<div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/admin_navigation.php"?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Bienvenidos a Admin :3
            <small><?php echo $_SESSION['user_name'];?></small>
          </h1>
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php"?>
