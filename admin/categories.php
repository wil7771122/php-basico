<?php ob_start()?>
<?php include "includes/admin_header.php"?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                    </div>
                    <div class="col-xs-6">
<?php
delete_category();
insert_category();
?>
                      <form action="" method="post">
                          <div class="form-group">
                            <label for="cat_title">Category Title</label>
                            <input class="form-control" type="text" name="cat_title" id="cat_title">
                          </div>
                          <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit">
                          </div>
                      </form>

<?php
// para modificar
if (isset($_GET['edit'])) {
  $cat_id = $_GET['edit'];
  include "includes/update_category.php";
}
?>
                    </div>
                    <div class="col-xs-6">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Category title</th>
                            <th>Options</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
find_all_categories();
?>
                        </tbody>
                      </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"?>
