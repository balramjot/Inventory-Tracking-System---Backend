<?php include '../view/header.php';?>                                    <!-- including header file -->
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
             <a href="<?php echo APP_URL; ?>/transactions/index.php?action=view&view_id=<?php echo $_GET['user_id']; ?>" class="previous" style="float:left;font-size:17px;text-decoration:none;">&laquo; Back</a><h2><center>Part Information</center></h2>
            <hr style="border-color:#808080"/>
            <div class="clear ht_20"></div>
    <div id="content-wrapper">
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="category">Category:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="category" disabled>
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
                    <input type="text" class="form-control" id="part_name" name="part_name" value="<?php if(!empty($partInfo)) { echo $partInfo->getPartName(); } ?>" placeholder="Enter Part Name" disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="part_no">Part Number:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="part_no" name="part_no" value="<?php if(!empty($partInfo)) { echo $partInfo->getPartNo(); } ?>" placeholder="Enter Part Number" disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="description">Description:</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" placeholder="Enter Description" disabled><?php if(!empty($partInfo)) { echo $partInfo->getDescription(); } ?></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="quantity">Quantity:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php if(!empty($partInfo)) { echo $partInfo->getQuantity(); } ?>" placeholder="Enter Quantity" disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="image">Image:</label>
                <div class="col-sm-6">
                <img src="<?php echo $partInfo->getImage(); ?>" style="width:100px;height:100px;border:3px solid #D0D0D0;border-radius:5px;"/>
                </div>
            </div>
        </div>
            </div>      
          </div>
        </div>
    <div class="clear ht_20"></div>
<?php include '../view/footer.php'; ?>                                                             <!-- including footer file -->