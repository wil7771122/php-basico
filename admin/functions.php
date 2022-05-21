<?php
function insert_category() {
  // Consulta para Crear Nuevo Registro
  global $connection;
  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    if ($cat_title == "" || empty($cat_title)) {
      echo "este campo no debe ser vacio";
    } else {
      $query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
      $create_category = mysqli_query($connection, $query);
      if (!$create_category) {
        die('QUERY FALLIDA' . mysqli_error);
      } else {
        header("Location: categories.php");
      }
    }
  }
}

function find_all_categories() {
  // COnsulta para obtener categorias
  global $connection;
  $query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>$cat_id</td>";
    echo "<td>$cat_title</td>";
    echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
    echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
    echo "</tr>";
  }
}

function delete_category() {
  // Consulta para Eliminar
  global $connection;
  if (isset($_GET['delete'])) {
    $cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = $cat_id";
    $delete_category = mysqli_query($connection, $query);
    header("Location: categories.php");
  }
}

function check_query($result){
  global $connection;
  if(!$result){
    die("Consulta Fallida " . mysqli_error($connection));
  }
}
?>