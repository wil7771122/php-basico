<form action="" method="post">
                        <?php
if (isset($_GET['edit'])) {
  $cat_edit = $_GET['edit'];
  $query = "SELECT * FROM categories WHERE cat_id = $cat_edit";
  $update_category = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($update_category)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    ?>
                          <div class="form-group">
                            <label for="cat_title">Edit Title</label>
                            <input class="form-control" type="text" name="cat_title" id="cat_title" value="<?php if (isset($cat_title)) {echo $cat_title;}?>">
                          </div>
                          <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_category" value="Update">
                          </div>
<?php }}?>
<?php
// Para modificar
if (isset($_POST['update_category'])) {
  $cat_title = $_POST['cat_title'];
  $query = "UPDATE categories set cat_title = '$cat_title' WHERE cat_id = $cat_id";
  $update_category = mysqli_query($connection, $query);
  if (!$update_category) {
    die('QUERY FALLIDA' . mysqli_error);
  }
}
?>
                      </form>