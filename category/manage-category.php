<?php include '../view/header.php';?>                                    <!-- including header file -->
<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <h2><center>Manage Category</center></h2>
            <hr style="border-color:#808080"/>
<!-- display alerts -->
            <?php if(!empty($_SESSION['error'])) { echo "<div class='alert alert-danger' role='alert'>".$_SESSION['error']."</div>"; } ?>
            <?php if(!empty($_SESSION['success'])) { echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>"; } ?>
            <div class="clear ht_20"></div>
            <div id="content-wrapper">

<div class="container-fluid">
  <!-- Area Chart Example-->
  <div class="card mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S No.</th>
              <th>Category Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
  if(!empty($allcategorys))
  {
    $i = 1;
  foreach($allcategorys as $allcategory)
  {
?>
            <tr>
            <td><?php echo $i; ?></td>
              <td><?php echo $allcategory->getname(); ?></td>
              <td>
              <?php
                if($allcategory->getStatus() == 1)
                {
              ?>
                <form method="POST" action="index.php">
                  <input type="hidden" name="action" value="deactivate"/>
                  <input type="hidden" name="stat_id" value="<?php echo $allcategory->getID(); ?>"/>
                  <button type="submit" title="Publish" class="btn btn-xs btn-success" style="padding: 1px 15px;">Publish</button>
                </form>
              <?php
                }
                else
                {
              ?>
                <form method="POST" action="index.php">
                  <input type="hidden" name="action" value="activate"/>
                  <input type="hidden" name="stat_id" value="<?php echo $allcategory->getID(); ?>"/>
                  <button type="submit" title="Unpublish" class="btn btn-xs btn-warning" style="padding: 1px 15px;">Unpublish</button>
                </form>
              <?php
                }
              ?>
              </td>
              <td>
                <a href="?action=edit&edit_id=<?php echo $allcategory->getID(); ?>" class="btn btn-xs btn-info" style="padding: 1px 15px;">Edit</a>
                <a href="?action=delete&del_id=<?php echo $allcategory->getID(); ?>" class="btn btn-xs btn-danger" style="padding: 1px 15px;" onclick="return confirm('Are you sure you want to delete this record ? This action cannot be undone. Continue ?')">Delete</a>
              </td>
              
            </tr>
<?php
    $i++;
   }
  }
  else
  {
      echo "<tr colspan='4'><td>No category added yet !!!</td></tr>";
  }
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>   
</div>
</div>  
          </div>
        </div>
    <div class="clear ht_20"></div>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>

<?php include '../view/footer.php'; ?>                                                             <!-- including footer file -->