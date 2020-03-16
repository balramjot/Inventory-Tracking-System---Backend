<?php include '../view/header.php';?>                                    <!-- including header file -->
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <h2><center>Add Part</center></h2>
            <hr style="border-color:#808080"/>
<!-- display alerts -->  
            <?php if(!empty($_SESSION['error'])) { echo "<div class='alert alert-danger' role='alert'>".$_SESSION['error']."</div>"; } ?>
            <?php if(!empty($_SESSION['success'])) { echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>"; } ?>
            <div class="clear ht_20"></div>
    <div id="content-wrapper">

      <form class="form-horizontal" action="index.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="category">Category:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="category" required>
                        <option value="">- Select Category -</option>
                    <?php
                        if(!empty($categorys))
                        {
                            foreach($categorys as $category)
                            {
                    ?>
                                <option value="<?php echo $category->getID(); ?>"<?php if(!empty($partInfo)) { if($category->getname() == $partInfo->getCategoryID()) { echo 'selected="selected"'; } } ?>><?php echo $category->getname(); ?></option>
                    <?php
                            }
                        }
                    ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="part_name">Part Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="part_name" name="part_name" value="<?php if(!empty($partInfo)) { echo $partInfo->getPartName(); } ?>" placeholder="Enter Part Name" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="part_no">Part Number:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="part_no" name="part_no" value="<?php if(!empty($partInfo)) { echo $partInfo->getPartNo(); } ?>" placeholder="Enter Part Number" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="description">Description:</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" placeholder="Enter Description" required><?php if(!empty($partInfo)) { echo $partInfo->getDescription(); } ?></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="quantity">Quantity:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php if(!empty($partInfo)) { echo $partInfo->getQuantity(); } ?>" placeholder="Enter Quantity" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="image">Image:</label>
                <div class="col-sm-6">
                <?php
                    if(!empty($partInfo))
                    {
                ?>
                    <img src="<?php echo $partInfo->getImage(); ?>" style="width:100px;height:100px;border:3px solid #D0D0D0;border-radius:5px;"/>
                    <input type="hidden" name="hidden_image" value="<?php echo $partInfo->getImageName(); ?>" />
                <?php
                    }
                ?>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="dummy">&nbsp;</label>
                <div class="col-sm-6">
                <?php
                    if(!empty($partInfo))
                    {
                ?>
                    <input type="hidden" name="action" value="editPart" />
                    <input type="hidden" name="edit_id" value="<?php echo $partInfo->getID(); ?>" />
                <?php
                    }
                    else
                    {
                ?>                
                    <input type="hidden" name="action" value="newPart" />
                <?php
                    }
                ?>
                    <button type="submit" class="btn btn-success" name="addpart">Submit</button>
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