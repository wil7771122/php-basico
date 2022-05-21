<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/functions.php"?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <?php
          if( isset($_GET['p_id'])){
            $post_id = $_GET['p_id'];
          }
          $query = "SELECT * FROM posts WHERE post_id = $post_id";
          $select_posts = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
        ?>

        <!-- First Blog Post -->
        <h2>
            <a href="#"><?php echo $post_title ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>

        <hr>
        <?php
          }
        ?>
        <!-- Blog Comments -->
        <?php
          if(isset($_POST['create_comment'])){
            $post_id = $_GET['p_id'];
            $comment_author = $_POST['comment_author'];
            $comment_content = $_POST['comment_content'];
            $comment_email = $_POST['comment_email'];

            if(!empty($comment_author) && !empty($comment_content) && !empty($comment_email)) {
              $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'no aprobado', now())";
              $result_insert_comment = mysqli_query($connection, $query);
              check_query($result_insert_comment);
              // Para Actualizar contador de comentarios
              $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
              $result_count_update = mysqli_query($connection, $query);
              check_query($result_count_update);
              // para refrescar la pagina
              header("Location ''");
            } else {
              echo '<script>alert(\'los campos del comentario no deben ser vacios\')</script>';
            }

          }
        ?>
        <!-- Comments Form -->
        <div class="well">
          <h4>Deja tu comentario:</h4>
          <form action="" role="form" method="POST" >
            <div class="form-group">
              <label for="comment_author">Autor</label>
              <input type="text" class="form-control" name="comment_author" id="comment_author">
            </div>
            <div class="form-group">
              <label for="comment_email">Correo</label>
              <input type="email" class="form-control" name="comment_email" id="comment_email">
            </div>
            <div class="form-group">
              <label for="comment_content">Comentario</label>
              <textarea class="form-control" rows="3" name="comment_content" id="comment_content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
          </form>
        </div>

        <hr>

        <!-- Posted Comments -->
        <?php
          $post_id = $_GET['p_id'];
          $query = "SELECT * FROM comments WHERE comment_post_id = $post_id and comment_status = 'aprobado' order by comment_id desc";
          $select_comments = mysqli_query($connection, $query);
          check_query($select_comments);
          while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
        ?>
        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="http://via.placeholder.com/64x64" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><?php echo $comment_author;?>
              <small><?php echo $comment_date;?></small>
            </h4>
            <small><?php echo $comment_content;?></small>
            
          </div>
        </div>
        <?php  
          }
        ?>
      </div>
      <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
    <hr>
<?php include "includes/footer.php"; ?>
