<?php include '../view/header.php';?>                                    <!-- including header file -->
<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <h2><center>All Transactions</center></h2>
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
              <th>Full Name</th>
              <th>Total Transactions</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
  if(!empty($alltransactions))
  {
    $i = 1;
  foreach($alltransactions as $alltransaction)
  {
?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><a href="../users/index.php?action=viewUser&view_id=<?php echo $alltransaction->getuserid(); ?>" style="text-decoration:none;"><?php echo $alltransaction->getusername(); ?></a></td>
              <td><?php echo $alltransaction->gettotal_trans(); ?></td>
              <td>
                <a href="?action=view&view_id=<?php echo $alltransaction->getuserid(); ?>" class="btn btn-xs btn-info" style="padding: 1px 15px;">View</a>
              </td>
              
            </tr>
<?php
    $i++;
   }
  }
  else
  {
      echo "<tr colspan='4'><td>No Transaction yet !!!</td></tr>";
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