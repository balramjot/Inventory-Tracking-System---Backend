<?php include '../view/header.php'; ?>                                   
<body class="bg-color">
<?php include '../view/afterloginHeader.php';  ?>     
    <div class="container cont_cls">
            <h2><center>Dashboard</center></h2>
            <hr style="border-color:#808080"/>
            <div class="clear ht_20"></div>
    <div id="content-wrapper">
<?php
// queries to show total users, transactions and parts

  $usrcnt = "SELECT id FROM user";
  $stmt_usrcnt = $db->prepare($usrcnt);
  $stmt_usrcnt->execute();
  $fet_usrcnt = $stmt_usrcnt->rowCount();
  $stmt_usrcnt->closeCursor();

  $partcnt = "SELECT id FROM parts";
  $stmt_partcnt = $db->prepare($partcnt);
  $stmt_partcnt->execute();
  $fet_partcnt = $stmt_partcnt->rowCount();
  $stmt_partcnt->closeCursor();

  $trnscnt = "SELECT id FROM transaction";
  $stmt_trnscnt = $db->prepare($trnscnt);
  $stmt_trnscnt->execute();
  $fet_trnscnt = $stmt_trnscnt->rowCount();
  $stmt_trnscnt->closeCursor();
?>
            <div class="container-fluid">
            <div class="col-md-12">
              <div class="col-md-3 btn btn-success">
                <span><i class="glyphicon glyphicon-user" style="font-size:22px;"></i>&nbsp; Total Number of Users</span>
                <br/>
                <span style="font-size:25px;"><?php echo $fet_usrcnt; ?></span>
              </div>
              <div class="col-md-3 btn btn-warning" style="margin-left:12%;margin-right:12%;">
                <span><i class="glyphicon glyphicon-asterisk" style="font-size:22px;"></i>&nbsp; Total Number of Parts</span>
                <br/>
                <span style="font-size:25px;"><?php echo $fet_partcnt; ?></span>
              </div>
              <div class="col-md-3 btn btn-danger">
                <span><i class="glyphicon glyphicon-usd" style="font-size:22px;"></i>&nbsp; Total Number of Transactions</span>
                <br/>
                <span style="font-size:25px;"><?php echo $fet_trnscnt; ?></span>
              </div>
            </div>
            <div class="clear ht_20"></div>
              <!-- Area Chart Example-->
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-area"></i>
                  Transactions Per Parts</div>
                <div class="card-body">
                  <div id="barchart" style="height: 400px; width: 100%;"></div>       <!-- barchart -->
                </div>
              </div>
                <div class="clear ht_20"></div>
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-area"></i>
                  Transactions Per Category</div>
                <div class="card-body">
                  <div id="piechart" style="height: 400px; width: 100%;"></div>         <!-- piechart -->
                </div>
              </div>
      
            </div>      
          </div>
        </div>
    <div class="clear ht_20"></div>
<?php
  //queries for the graphs and charts

  $qur_pie = "SELECT COUNT(transaction.part_id) AS total,transaction.part_id,parts.category_id,category.name FROM transaction,parts,category WHERE transaction.part_id = parts.id and parts.category_id = category.id GROUP BY transaction.part_id";
  $stmt_pie = $db->prepare($qur_pie);
  $stmt_pie->execute();
  $fet_pie = $stmt_pie->fetchAll();
  $stmt_pie->closeCursor();

  $qur_bar = "SELECT COUNT(transaction.part_id) AS total,transaction.part_id,parts.part_no FROM transaction,parts WHERE transaction.part_id = parts.id GROUP BY transaction.part_id";
  $stmt_bar = $db->prepare($qur_bar);
  $stmt_bar->execute();
  $fet_bar = $stmt_bar->fetchAll();
  $stmt_bar->closeCursor();
 
?>

    <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

 <!-- jquery functions for barchart and piechart-->
  <script>
window.onload = function () {

var options = {
  animationEnabled: true,
  backgroundColor: "#e4e6eb",
  data: [{
    type: "doughnut",
    innerRadius: "40%",
    showInLegend: true,
    legendText: "{label}",
    indexLabel: "{label}: #percent%",
    dataPoints: [
    <?php
      if(!empty($fet_pie))
      {
        foreach($fet_pie as $piedata)
        {
            ?>
            { label: "<?php echo $piedata['name']; ?>", y: <?php echo $piedata['total']; ?> },
    <?php
        }
      }
    ?>
    ]
  }]
};
$("#piechart").CanvasJSChart(options);


var options = {
  backgroundColor : "#e4e6eb",
  data: [              
  {
    // Change type to "doughnut", "line", "splineArea", etc.
    type: "column",
    dataPoints: [
    <?php
    if(!empty($fet_bar))
    {
      foreach($fet_bar as $bardata)
      {
          ?>
      { label: "<?php echo $bardata['part_no']; ?>",  y: <?php echo $bardata['total']; ?>  },
    <?php
      }
    }
    ?>
    ]
  }
  ]
};

$("#barchart").CanvasJSChart(options);

}
</script>
<script src="../js/demo/jquery.canvasjs.min.js"></script>
  <?php include '../view/footer.php'; ?>                                                             <!-- including footer file -->