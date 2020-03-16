<?php
    require('../model/database.php');                                      // importing database connection file
    require('../model/users.php');                                          // importing constructor class file
    require('../model/users_db.php');                                       // importing function file
    require('../model/category.php');                                       // importing constructor class file
    require('../model/category_db.php');                                     // importing function file
    require('../model/part.php');                                           // importing constructor class file
    require('../model/part_db.php');                                        // importing function file
    require('../model/transaction.php');                                       // importing constructor class file
    require('../model/transaction_db.php');                                    // importing function file

$action = filter_input(INPUT_POST, 'action');                                   // checking the value in action coming from post method

// all transaction page if action is empty

if ($action == NULL)                                                            
{
    $action = filter_input(INPUT_GET, 'action');                          // checking the value in action coming from get method
    if ($action == NULL)                                                        // nothing found in action
    {  
    	$alltransactions = TransactionDB::getTransactionList();
        header('Location: all-transaction.php');
    }
}

// for showing all the inventory transactions

if($action == 'allTransaction')
{
    $alltransactions = TransactionDB::getTransactionList();
    include('all-transaction.php'); 
}

// viewing particular transaction

elseif($action == 'view')
{
    $id = filter_input(INPUT_GET, 'view_id',FILTER_VALIDATE_INT);
    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: all-transaction.php');  
    }
    else
    {
        $userTransactions = TransactionDB::getTransactionUserList($id);
        include('transaction.php'); 
    }
}

// deleting a transaction

elseif($action == 'delete')
{
    $id = filter_input(INPUT_GET, 'del_id',FILTER_VALIDATE_INT);
    $user_id = filter_input(INPUT_GET, 'user_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE || $user_id == NULL || $user_id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=view&view_id='.$user_id); 
    }
    else
    {
        $table = 'transaction';
        $_SESSION['success'] = "Transaction has been deleted successfully.";
        TransactionDB::delete($id,$table);
        header('Location: index.php?action=view&view_id='.$user_id);
    }
}

// mark transaction as read

elseif($action == 'read')
{
    $id = filter_input(INPUT_GET, 'read_id',FILTER_VALIDATE_INT);
    $user_id = filter_input(INPUT_GET, 'user_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE || $user_id == NULL || $user_id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=view&view_id'.$user_id);
    }
    else
    {
        $table = 'transaction';
        $_SESSION['success'] = "Transaction has been mark as read.";
        TransactionDB::deactivate($id,$table);
        header('Location: index.php?action=view&view_id='.$user_id);
    }
}

// mark transaction as read for ajax function
elseif($action == 'markAsReadAjax')
{
    $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);

    if ($id == NULL || $id == FALSE)
    {
        $result = '2@';
        echo  $result;
    }
    else
    {
        $table = 'transaction';
        TransactionDB::deactivate($id,$table);
        $result = TransactionDB::subtractQuantity();
        echo $result;
    }
    
}

?>

