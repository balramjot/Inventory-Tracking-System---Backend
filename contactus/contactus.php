<?php include '../view/header.php';?>                                    <!-- including header file -->
<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <h2><center>Contact US Messages</center></h2>
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
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
  if(!empty($contactus))
  {
    $i = 1;
  foreach($contactus as $contact)
  {
?>
            <tr>
            <td><?php echo $i; ?></td>
              <td><?php echo $contact->getName(); ?></td>
              <td><?php echo $contact->getEmail(); ?></td>
              <td><?php echo $contact->getSubject(); ?></td>
              <td><?php echo $contact->getMessage(); ?></td>
              <td>
                <a href="?action=delete&del_id=<?php echo $contact->getID(); ?>" class="btn btn-xs btn-danger" style="padding: 1px 15px;" onclick="return confirm('Are you sure you want to delete this record ? This action cannot be undone. Continue ?')">Delete</a>
              </td>
              
            </tr>
<?php
    $i++;
   }
  }
  else
  {
      echo "<tr colspan='7'><td>No message for you yet !!!</td></tr>";
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