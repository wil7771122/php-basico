<?php session_start();?>
<?php include "db.php";?>

<?php
  if(isset($_POST['login'])) {
    $post_user_name = $_POST['user_name'];
    $post_user_password = $_POST['user_password'];
    // Para evitar inyeccion sql
    $post_user_name = mysqli_real_escape_string($connection, $post_user_name);
    $post_user_password = mysqli_real_escape_string($connection, $post_user_password);
    $query = "SELECT * FROM users WHERE user_name = '$post_user_name' and user_password = '$post_user_password' ";
    $result = mysqli_query($connection, $query);
    if(!$result){
      die("Consulta Fallida " . mysqli_error($connection));
    }
  }

  $user_name = null;
  $user_password = null;

  while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
  }
  if($post_user_name == $user_name && $post_user_password == $user_password){

    $_SESSION['user_name'] = $user_name;
    $_SESSION['db_first_name'] = $db_first_name;
    $_SESSION['user_firstname'] = $user_firstname;
    $_SESSION['user_lastname'] = $user_lastname;
    $_SESSION['user_role'] = $user_role;
    header("Location: ../admin");
  } else {
    header("Location: ../index.php");
  }
?>