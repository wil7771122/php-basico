<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Autor</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Estado</th>
      <th>En respuesta a</th>
      <th>Aprobar</th>
      <th>No Aprobar</th>
      <th>Fecha</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query = "SELECT * FROM comments";
      $select_posts = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($select_posts)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        
        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";
        $query_post = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $result_post = mysqli_query($connection, $query_post);
        while ($row = mysqli_fetch_assoc($result_post)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
        }
        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>";
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Aprobar</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>No Aprobar</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>edit</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>delete</a></td>";
        echo "</tr>";
      }
    ?>
    
  </tbody>
</table>
<?php
  if(isset($_GET['unapprove'])){
    $comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'no aprobado' WHERE comment_id = $comment_id";
    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: comments.php");
  }

  if(isset($_GET['approve'])){
    $comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'aprobado' WHERE comment_id = $comment_id";
    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: comments.php");
  }

  if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = $comment_id";
    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: comments.php");
  }
?>
