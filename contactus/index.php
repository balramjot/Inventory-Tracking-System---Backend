<?php
    require('../model/database.php');                                      // importing database connection file
    require('../../model/contactus.php');                                       // importing constructor class file
    require('../../model/contactus_db.php');                                    // importing function file

$action = filter_input(INPUT_POST, 'action');                                   // checking the value in action coming from post method

// contact us page if action is empty

if ($action == NULL)                                                            
{
    $action = filter_input(INPUT_GET, 'action');                                // checking the value in action coming from get method
    if ($action == NULL)                                                        // nothing found in action
    {  
        $contactus = ContactDB::getCategoryList();
        include('contactus.php');
    }
}

// contact us page

if($action == 'contactUS')
{
    $contactus = ContactDB::getContactUSList();
    include('contactus.php');
}

// deleting contact us message

elseif($action == 'delete')
{
    $id = filter_input(INPUT_GET, 'del_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=contactUS');  
    }
    else
    {
        $table = 'contactus';
        $_SESSION['success'] = "Message has been deleted successfully.";
        ContactDB::delete($id,$table);
        header('Location: index.php?action=contactUS'); 
    }
}

?>

