<?php
  if(isset($_POST['create_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    // en caso de archivos
    // Para obtener imagenes se debe utilizar la super global $_FILES
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES($post_category_id, '$post_title', '$post_author', '$post_date', '$post_image', '$post_content', '$post_tags', '$post_status')";

    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: posts.php");
  }

?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Titulo</label>
    <input type="text" class="form-control" name="post_title" id="post_title">
  </div>
  <div class="form-group">
    <label for="post_category_id">Post Categoria</label>  
    <select name="post_category_id" id="post_category_id">
      <?php
        $query_categories = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query_categories);
        check_query($select_categories);
        while ($category_row = mysqli_fetch_assoc($select_categories)) {
          $cat_id = $category_row['cat_id'];
          $cat_title = $category_row['cat_title'];
          echo "<option value='$cat_id'>$cat_title</option>";
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post_author">Post Autor</label>
    <input type="text" class="form-control" name="post_author" id="post_author">
  </div>
  <div class="form-group">
    <label for="post_status">Post Estado</label>
    <select class="form-control" name="post_status" id="post_status">
      <option selected disabled>Seleccionar</option>
      <option value="borrador">borrador</option>
      <option value="publicado">publicado</option>
    </select>
  </div>
  <div class="form-group">
    <label for="post_image">Post Imagen</label>
    <input type="file" name="post_image" id="post_image">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags (etiquetas)</label>
    <input type="text" class="form-control" name="post_tags" id="post_tags">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publicar Post">
  </div>
</form>