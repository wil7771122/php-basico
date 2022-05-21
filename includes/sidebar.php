<?php
  session_start();
  ?>
<div class="col-md-4">

  <!-- Blog Search Well -->
  <div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="POST">
      <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit" name="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form>
    <!-- /.input-group -->
  </div>

  <!-- Blog Categories Well -->
  <?php
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    ?>

  <?php
  if($_SESSION["user_name"]== null){
  ?>
  <div class="well">
    <h4>Login</h4>0
    <form action="includes/login.php" method="POST">
      <div class="form-group">
        <input type="text" class="form-control" name="user_name" placeholder="Ingresar Usuario">
      </div>
      <div class="input-group">
        <input type="password" class="form-control" name="user_password" placeholder="Ingresar Clave">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary" name="login">
            Submit
          </button>
        </span>
      </div>
    </form>
    <!-- /.input-group -->
  </div>
  <?php } ?>
  <div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
      <div cla ss="col-lg-12">
        <ul class="list-unstyled">
          <?php
            while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<li> <a href='category.php?category=$cat_id'>$cat_title</a></li>";
            }
          ?>
        </ul>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- Side Widget Well -->
  <?php include "widget.php"?>

</div>