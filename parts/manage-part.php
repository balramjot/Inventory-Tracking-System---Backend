<?php include '../view/header.php';?>                                    <!-- including header file -->
<style>
.hide_this{
  display:none;
}
</style>
<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <h2><center>Manage Part</center></h2>
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
              <th>Image</th>
              <th>Category Name</th>
              <th>Part Name</th>
              <th>Part Number</th>
              <th>Description</th>
              <th>Quantity</th>
              <th>Added On</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
  if(!empty($allparts))
  {
    $i = 1;
  foreach($allparts as $allpart)
  {
?>
            <tr>
            <td><?php echo $i; ?></td>
              <td><img src="<?php echo $allpart->getImage(); ?>" style="width:70px;height:70px;"/></td>
              <td><?php echo $allpart->getCategoryID(); ?></td>
              <td><?php echo $allpart->getPartName(); ?></td>
              <td><?php echo $allpart->getPartNo(); ?></td>
              <td><?php echo $allpart->getDescription(); ?></td>
              <td>
                <span class="show_parent" id="first_child-<?php echo $allpart->getID(); ?>"><?php echo $allpart->getQuantity(); ?>&nbsp;
                    <i class="glyphicon glyphicon-pencil editquantity" style="color:#337ab7;cursor:pointer;" title="Edit Quantity" alt="quantityvalue-<?php echo $allpart->getID(); ?>"></i>
                </span>
                <span class="show_child">
                    <input type="text" class="hide_this quantityvalue-<?php echo $allpart->getID(); ?>" value="<?php echo $allpart->getQuantity(); ?>" style="width:50px;"/>&nbsp;
                    <i class="glyphicon glyphicon-check hide_this quantityvalue-<?php echo $allpart->getID(); ?> submit_qty" style="color:green;cursor:pointer;" title="Submit Quantity" alt="quantityvalue-<?php echo $allpart->getID(); ?>"></i>
                </span>
              </td>
              <td><?php echo $allpart->getDateTime(); ?></td>
              <td>
              <?php
                if($allpart->getStatus() == 1)
                {
              ?>
                <form method="POST" action="index.php">
                  <input type="hidden" name="action" value="deactivate"/>
                  <input type="hidden" name="stat_id" value="<?php echo $allpart->getID(); ?>"/>
                  <button type="submit" title="Publish" class="btn btn-xs btn-success" style="padding: 1px 15px;">Publish</button>
                </form>
              <?php
                }
                else
                {
              ?>
                <form method="POST" action="index.php">
                  <input type="hidden" name="action" value="activate"/>
                  <input type="hidden" name="stat_id" value="<?php echo $allpart->getID(); ?>"/>
                  <button type="submit" title="Unpublish" class="btn btn-xs btn-warning" style="padding: 1px 15px;">Unpublish</button>
                </form>
              <?php
                }
              ?>
              </td>
              <td>
                <a href="?action=edit&edit_id=<?php echo $allpart->getID(); ?>" class="btn btn-xs btn-info" style="padding: 1px 15px;">Edit</a>
                <a href="?action=delete&del_id=<?php echo $allpart->getID(); ?>" class="btn btn-xs btn-danger" style="padding: 1px 15px;" onclick="return confirm('Are you sure you want to delete this record ? This action cannot be undone. Continue ?')">Delete</a>
              </td>
              
            </tr>
<?php
    $i++;
   }
  }
  else
  {
      echo "<tr colspan='10'><td>No category added yet !!!</td></tr>";
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

  <script>
$(function () {
    
    $( ".editquantity" ).click(function() {
        $(".show_parent").show();
        $( this ).parent().hide();
        $(".hide_this").hide();
        var qty = $(this).attr('alt');
        $("."+qty).show();  
    });

    
    $( ".submit_qty" ).click(function(e) {
        var quantity = $( this ).parent().find('input').val();
        var fullid = $(this).attr('alt');
        var strsplt = fullid.split('-');
        var id = strsplt[1];
        var quantity_box = $( this ).parent().find('input');

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'index.php',
            data: {id: id, quantity : quantity, action : 'changeQuantityAjax'},
            success: function(response)
            {
              var jsonData = JSON.parse(response);
              if(jsonData == '1')
              {
                  $(quantity_box).css("display","none");
                  $(".submit_qty").hide();
                  $(".show_parent").show();
                  $("#first_child-"+id).html(quantity+' <i class="glyphicon glyphicon-pencil editquantity" style="color:#337ab7;cursor:pointer" title="Edit Quantity" alt="quantityvalue-'+id+'"></i>');
              }
              else
              {
                  $(quantity_box).css("border","1px solid red");
                  return false;
              }
           }
       });


    });

});
</script>

<?php include '../view/footer.php'; ?>                                                             <!-- including footer file -->