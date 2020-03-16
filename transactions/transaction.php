<?php include '../view/header.php';?>                                    <!-- including header file -->
<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <a href="<?php echo APP_URL; ?>/transactions/index.php?action=allTransaction" class="previous" style="float:left;font-size:17px;text-decoration:none;">&laquo; Back</a><h2><center>Transaction Record</center></h2>
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
              <th>Part Name</th>
              <th>Quantity Out</th>
              <th>Withdraw Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
  if(!empty($userTransactions))
  {
    $i = 1;
  foreach($userTransactions as $userTransaction)
  {   

?>
            <tr <?php if($userTransaction->getStatusval() == '1') { echo 'style="background-color:#a9dd9c"'; } ?>>
              <td><?php echo $i; ?></td>
              <td><?php echo $userTransaction->getusername(); ?></td>
              <td><a href="../parts/index.php?action=viewPart&view_id=<?php echo $userTransaction->getpartid(); ?>&user_id=<?php echo $_GET['view_id']; ?>" style="text-decoration:none;"><?php echo $userTransaction->getuserid(); ?></a></td>
              <td><?php echo $userTransaction->gettotal_trans(); ?></td>
              <td><?php echo date("F d,Y", strtotime($userTransaction->getStatus())); ?></td>
              <td>
            <?php if($userTransaction->getStatusval() == '1') { ?>
              <a href="?action=read&read_id=<?php echo $userTransaction->getID(); ?>&user_id=<?php echo $_GET['view_id']; ?>" class="btn btn-xs btn-primary" style="padding: 1px 15px;">Mark as Read</a>
            <?php } ?>
              <a href="?action=delete&del_id=<?php echo $userTransaction->getID(); ?>&user_id=<?php echo $_GET['view_id']; ?>" class="btn btn-xs btn-danger" style="padding: 1px 15px;" onclick="return confirm('Are you sure you want to delete this record ? This action cannot be undone. Continue ?')">Delete</a>
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