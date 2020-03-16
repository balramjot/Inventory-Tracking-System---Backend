<?php include '../view/header.php';?>                                    <!-- including header file -->
<body class="bg-color">
<?php include '../view/afterloginHeader.php';?> 
    <div class="container cont_cls">
            <a href="<?php echo APP_URL; ?>/transactions/index.php?action=allTransaction" class="previous" style="float:left;font-size:17px;text-decoration:none;">&laquo; Back</a><h2><center>View User</center></h2>
            <hr style="border-color:#808080"/>
            <div class="clear ht_20"></div>
    <div id="content-wrapper">

        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php if(!empty($userInfo)) { echo $userInfo->getFirstName(); } ?>" placeholder="Enter First Name" disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="<?php if(!empty($userInfo)) { echo $userInfo->getLastName(); } ?>" disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">Email:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php if(!empty($userInfo)) { echo $userInfo->getemail(); } ?>" disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label col-sm-3" for="email">Password:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" id="password" placeholder="Enter Password" value="<?php if(!empty($userInfo)) { echo $userInfo->getPassword(); } ?>" disabled>
                </div>
            </div>
        </div>
            </div>      
          </div>
        </div>
    <div class="clear ht_20"></div>
<?php include '../view/footer.php'; ?>                                                             <!-- including footer file -->