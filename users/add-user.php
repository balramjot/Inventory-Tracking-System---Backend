<?php include '../view/header.php';?>                                    <!-- including header file -->
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <h2><center>Add User</center></h2>
            <hr style="border-color:#808080"/>
<!-- displaying alerts -->
            <?php if(!empty($_SESSION['error'])) { echo "<div class='alert alert-danger' role='alert'>".$_SESSION['error']."</div>"; } ?>
            <?php if(!empty($_SESSION['success'])) { echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>"; } ?>
            <div class="clear ht_20"></div>
    <div id="content-wrapper">

      <form class="form-horizontal" action="index.php" method="POST">
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php if(!empty($userInfo)) { echo $userInfo->getFirstName(); } ?>" placeholder="Enter First Name" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="<?php if(!empty($userInfo)) { echo $userInfo->getLastName(); } ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">Email:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php if(!empty($userInfo)) { echo $userInfo->getemail(); } ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">Password:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" id="password" placeholder="Enter Password" value="<?php if(!empty($userInfo)) { echo $userInfo->getPassword(); } ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="dummy">&nbsp;</label>
                <div class="col-sm-6">
                <?php
                    if(!empty($userInfo))
                    {
                ?>
                    <input type="hidden" name="action" value="editUser" />
                    <input type="hidden" name="edit_id" value="<?php echo $userInfo->getID(); ?>" />
                <?php
                    }
                    else
                    {
                ?>                
                    <input type="hidden" name="action" value="newUser" />
                <?php
                    }
                ?>
                    <button type="submit" class="btn btn-success" name="adduser">Submit</button>
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