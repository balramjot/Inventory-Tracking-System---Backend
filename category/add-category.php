<?php include '../view/header.php';?>                                    <!-- including header file -->
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <h2><center>Add Category</center></h2>
            <hr style="border-color:#808080"/>
<!-- display alerts -->
            <?php if(!empty($_SESSION['error'])) { echo "<div class='alert alert-danger' role='alert'>".$_SESSION['error']."</div>"; } ?>
            <?php if(!empty($_SESSION['success'])) { echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>"; } ?>
            <div class="clear ht_20"></div>
    <div id="content-wrapper">

      <form class="form-horizontal" action="index.php" method="POST">
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="name">Category:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" value="<?php if(!empty($categoryInfo)) { echo $categoryInfo->getname(); } ?>" placeholder="Enter Category" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="dummy">&nbsp;</label>
                <div class="col-sm-6">
                <?php
                    if(!empty($categoryInfo))
                    {
                ?>
                    <input type="hidden" name="action" value="editCategory" />
                    <input type="hidden" name="edit_id" value="<?php echo $categoryInfo->getID(); ?>" />
                <?php
                    }
                    else
                    {
                ?>                
                    <input type="hidden" name="action" value="newCategory" />
                <?php
                    }
                ?>
                    <button type="submit" class="btn btn-success" name="addcategory">Submit</button>
                    <button type="button" class="btn btn-default" onClick="window.location.href=window.location.href">Cancel</button>
                </div>
            </div>
        </div>
      </form>
            </div>      
          </div>
        </div>
    <div class="clear ht_20"></div>
<?php include '../view/footer.php'; ?>                                                             <!-- including footer file -->