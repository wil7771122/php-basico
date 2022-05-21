<?php

  if(isset($_POST['create_user'])){
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    
    // en caso de archivos
    // Para obtener imagenes se debe utilizar la super global $_FILES
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_role = $_POST['user_role'];    
    move_uploaded_file($post_image_temp, "/images/$user_image");

    $query = "INSERT INTO users(user_name, user_password, user_email, user_firstname, user_lastname, user_image, user_role) VALUES('$user_name', '$user_password', '$user_email', '$user_firstname', '$user_lastname', '$user_image', '$user_role')";

    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: users.php");
  }

?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_name">Nombre de usuario</label>
    <input type="text" class="form-control" name="user_name" id="user_name">
  </div>
  <div class="form-group">
    <label for="user_password">Clave de usuario</label>
    <input type="password" class="form-control" name="user_password" id="user_password">
  </div>
  <div class="form-group">
    <label for="user_email">Correo de usuario</label>
    <input type="text" class="form-control" name="user_email" id="user_email">
  </div>
  <div class="form-group">
    <label for="user_firstname">Nombre</label>  
    <input type="text" class="form-control" name="user_firstname" id="user_firstname">
  </div>
  <div class="form-group">
    <label for="user_lastname">Apellido</label>  
    <input type="text" class="form-control" name="user_lastname" id="user_lastname">
  </div>
  <div class="form-group">
    <label for="user_image">Usuario Imagen</label>
    <input type="file" name="user_image" id="user_image">
  </div>
  <div class="form-group">
    <label for="user_role">Rol de Usuario</label>
    <select class="form-control" name="user_role" id="user_role">
      <option value="admin" disabled selected>Select Options</option>
      <option value="admin">admin</option>
      <option value="subscriber">subscriber</option>
    </select>
  </div>
 
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Crear Usuario">
  </div>
</form>