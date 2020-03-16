<?php require('../model/check_session.php'); ?>
<style>
.badge-notify{
   background:red;
   position:relative;
   top: -15px;
   left: -5px;
}
</style>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo APP_URL; ?>/dashboard/index.php?action=dashboard">Inventory Tracking System</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Users <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo APP_URL; ?>/users/index.php?action=addUsers">Add Users</a></li>
                <li><a href="<?php echo APP_URL; ?>/users/index.php?action=manageUsers">Manage Users</a></li>
                </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Parts <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo APP_URL; ?>/parts/index.php?action=addPart">Add Part</a></li>
                <li><a href="<?php echo APP_URL; ?>/parts/index.php?action=managePart">Manage Part</a></li>
                <li><a href="<?php echo APP_URL; ?>/parts/index.php?action=outOfStock">Out of Stock</a></li>
                </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Part Category <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo APP_URL; ?>/category/index.php?action=addCategory">Add Category</a></li>
                <li><a href="<?php echo APP_URL; ?>/category/index.php?action=manageCategory">Manage Category</a></li>
                </ul>
            </li>
            <li><a href="<?php echo APP_URL; ?>/transactions/index.php?action=allTransaction">All Transactions</a></li>
            <li><a href="<?php echo APP_URL; ?>/contactus/index.php?action=contactUS">Contact US</a></li>
        </ul>
<?php
    // for getting unviewed transactions count and result
    
        $db = Database::getDB();
        $qur = "SELECT * FROM transaction WHERE status = '1'";
        $stmt = $db->prepare($qur);
        $stmt->execute();
        $cntt = $stmt->fetchAll();
        $stmt->closeCursor();
?>
        <ul class="nav navbar-nav navbar-right"> 
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell" style="font-size:20px;"></i><?php if(!empty($cntt)) { ?><span class="badge badge-notify" id="remcnt"><?php echo count($cntt); ?></span><?php } ?></a>
                <ul class="dropdown-menu" style="width:300px;">
            <?php
                if(!empty($cntt))
                {
                    foreach($cntt as $notifi)
                    {
                        $qur1 = "SELECT part_name FROM parts WHERE id = '".$notifi['part_id']."'";
                        $stmt1 = $db->prepare($qur1);
                        $stmt1->execute();
                        $cntt1 = $stmt1->fetch();
                        $stmt1->closeCursor();

                        $qur2 = "SELECT first_name FROM user WHERE id = '".$notifi['user_id']."'";
                        $stmt2 = $db->prepare($qur2);
                        $stmt2->execute();
                        $cntt2 = $stmt2->fetch();
                        $stmt2->closeCursor();
            ?>
                <li class="hideli-<?php echo $notifi['id']; ?>"><div class="alert alert-info" role="info" style="margin-bottom:3px;"><span style="float:left;"><?php echo $cntt2['first_name'].' withdraw '.$notifi['quantity'].' units from '.$cntt1['part_name']; ?></span><span aria-hidden="true" style="float:right;cursor:pointer;" alt="<?php echo $notifi['id']; ?>" class="markasread">&times;</span><div class="clear"></div></div></li>
            <?php
                    }
                }
                else
                {
                   echo '<li><div class="alert alert-danger" role="danger">No new notification</div></li>'; 
                }
            ?>
                </ul>
            </li>
            
            
            <li><a href="../logout"><span class="glyphicon glyphicon-log-out"></span>  Sign Out</a></li>
        </ul>
            <div class="clear"></div>
    </div>
</nav>
<div class="clear ht_50"></div><div class="ht_20"></div>

