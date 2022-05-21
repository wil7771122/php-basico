<table class="table table-bordered table-hover">
  <thead>
    <tr>

      <th>Id</th>
      <th>Nombre de usuario</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Correo</th>
      <th>imagen</th>
      <th>Rol</th>
      <th>Cambiar a admin</th>
      <th>Cambiar a subscriptor</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query = "SELECT * FROM users";
      $select_posts = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($select_posts)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        
        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$user_name</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_image</td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?admin=$user_id'>admin</a></td>";
        echo "<td><a href='users.php?subscriber=$user_id'>subscriptor</a></td>";
        echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>edit</a></td>";
        echo "<td><a href='users.php?delete=$user_id'>delete</a></td>";
        echo "</tr>";
      }
    ?>
    
  </tbody>
</table>
<?php
  if(isset($_GET['admin'])){
    $user_id = $_GET['admin'];
    $query = "UPDATE users set user_role = 'admin' WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: users.php");
  }

  if(isset($_GET['subscriber'])){
    $user_id = $_GET['subscriber'];
    $query = "UPDATE users set user_role = 'subscriber' WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: users.php");
  }

  if(isset($_GET['delete'])){
    $user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);
    check_query($result);
    header("Location: users.php");
  }
?>
