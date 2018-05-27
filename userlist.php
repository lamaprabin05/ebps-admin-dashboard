<?php 
    include 'inc/header.php';
    include 'inc/nav.php';
    include 'class/user.php';
    include 'inc/functions.php';
    

    $user = new User(); // instating object.
    $user_info = $user->getAllUser(); //accessing the file from db tbl_user from specific functions.
    //debugger($user_info ,true);
?>


        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <!-- <p class="btn btn-primary">User List</p> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="user-add" class="btn btn-success"><i class="fa fa-plus"> Add User </i></a></li>
                           
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">User Listing:</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>S.N.:</th>
                        <th>UserName:</th>
                        <th>Account Type:</th>
                        <th>Consultancy Name:</th>
                        <th>Role:</th>
                        <th>Post:</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          foreach ($user_info as $key => $value) {
                            ?> 
                            <tr>
                              <td><?php echo ++$key; ?></td>
                              <td><?php echo $value->username; ?></td>
                              <td><?php echo $value->account_type; ?></td>
                              <td><?php echo $value->consultancy_name; ?></td>
                              <td><?php echo $value->role; ?></td>
                              <td><?php echo $value->post; ?></td>
                            </tr>
                      <?php
                          }
                      ?>
                      
        
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <?php 
      include 'inc/footer.php';
    ?>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>


</body>
</html>
