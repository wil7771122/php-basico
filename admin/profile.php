<?php include "includes/admin_header.php";?>

<?php
  if(isset($_SESSION['user_name'])){
    $session_user_name = $_SESSION['user_name'];
    $query = "SELECT * FROM users WHERE user_name = '$session_user_name'";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $user_name = $row['user_name'];
      $user_password = $row['user_password'];
      $user_email = $row['user_email'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];
    }
  }
  if(isset($_POST['update_profile'])){
    // $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    
    // en caso de archivos
    // Para obtener imagenes se debe utilizar la super global $_FILES
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_role = $_POST['user_role'];    
    move_uploaded_file($user_image_temp, "/images/$user_image");

    // $query = "INSERT INTO users(user_name, user_password, user_email, user_firstname, user_lastname, user_image, user_role) VALUES('$user_name', '$user_password', '$user_email', '$user_firstname', '$user_lastname', '$user_image', '$user_role')";

    $query = "UPDATE users SET user_name = '$user_name', user_password = '$user_password', user_email = '$user_email', user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_image = '$user_image', user_role = '$user_role' WHERE user_name = '$session_user_name'";

    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: ");
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
              Actualizar Perfil
          </h1>
          <form action="" method="post" enctype="multipart/form-data">
            <!-- <div class="form-group">
              <label for="user_name">Nombre de usuario</label>
              <input type="text" class="form-control" name="user_name" id="user_name" value ="<?php echo $user_name;?>">
            </div> -->
            <div class="form-group">
              <label for="user_password">Clave de usuario</label>
              <input type="password" class="form-control" name="user_password" id="user_password" value ="<?php echo $user_password;?>">
            </div>
            <div class="form-group">
              <label for="user_email">Correo de usuario</label>
              <input type="text" class="form-control" name="user_email" id="user_email" value ="<?php echo $user_email;?>">
            </div>
            <div class="form-group">
              <label for="user_firstname">Nombre</label>  
              <input type="text" class="form-control" name="user_firstname" id="user_firstname" value ="<?php echo $user_firstname;?>">
            </div>
            <div class="form-group">
              <label for="user_lastname">Apellido</label>  
              <input type="text" class="form-control" name="user_lastname" id="user_lastname" value ="<?php echo $user_lastname;?>">
            </div>
            <div class="form-group">
              <label for="user_image">Usuario Imagen</label>
              <input type="file" name="user_image" id="user_image">
            </div>
            <div class="form-group">
              <?php echo $user_role ?>
              <label for="user_role">Rol de Usuario</label>
              <select class="form-control" name="user_role" id="user_role">
                <option disabled selected>Select Options</option>
                <option value="admin" <?php echo $user_role == 'admin' ? 'selected' : '' ?>>admin</option>
                <option value="subscriber" <?php echo $user_role == 'subscriber' ? 'selected' : '' ?>>subscriber</option>
              </select>
            </div>
          
            <div class="form-group">
              <input class="btn btn-primary" type="submit" name="update_profile" value="Actualizar Perfil">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php"?>
