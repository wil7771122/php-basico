<?php
  if(isset($_GET['p_id'])){
    $post_id = $_GET['p_id'];
  }
  $query = "SELECT * FROM posts WHERE post_id = $post_id";
  $select_post = mysqli_query($connection, $query);
  while($row = mysqli_fetch_assoc($select_post)){
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_status = $row['post_status'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
  }

  if(isset($_POST['update_post']) && isset($post_id)){
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    if(empty($post_image)){
      $query_image = "SELECT * FROM posts WHERE post_id = $post_id";
      $select_image = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($select_image)) {
        $post_image = $row['post_image'];
      }
    }


    $update_query = "UPDATE posts SET post_title = '$post_title', post_category_id = $post_category_id, post_author = '$post_author', post_status = '$post_status', post_image = '$post_image', post_tags = '$post_tags', post_content = '$post_content', post_date = now() WHERE post_id = $post_id ";


    $update_result = mysqli_query($connection, $update_query);

    $post_image_temp = $_FILES['post_image']['tmp_name'];

    check_query($update_result);
    move_uploaded_file($post_image_temp, "../images/$post_image");
    header("Location: posts.php");
  }
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Titulo</label>
    <input type="text" class="form-control" name="post_title" id="post_title" value="<?php echo $post_title; ?>">
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
          if($cat_id == $post_category_id)
            echo "<option value='$cat_id' selected>$cat_title</option>";
          else
            echo "<option value='$cat_id'>$cat_title</option>";
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post_author">Post Autor</label>
    <input type="text" class="form-control" name="post_author" id="post_author" value="<?php echo $post_author; ?>">
  </div>
  <div class="form-group">
    <label for="post_status">Post Estado</label>
    <select class="form-control" name="post_status" id="post_status">
      <option selected disabled>Seleccionar</option>
      <option value="borrador" <?php echo $post_status == 'borrador' ? 'selected' : ''?>>borrador</option>
      <option value="publicado" <?php echo $post_status == 'publicado' ? 'selected' : ''?>>publicado</option>
    </select>
  </div>
  <div class="form-group">
    <img width="100" src="../images/<?php echo $post_image;?>" alt="">
    <input type="file" name="post_image">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags (etiquetas)</label>
    <input type="text" class="form-control" name="post_tags" id="post_tags" value="<?php echo $post_tags; ?>" >
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"><?php echo $post_content; ?></textarea>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Actualizar Post">
  </div>
</form>