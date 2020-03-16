<?php
    require('../model/database.php');                                      // importing database connection file
    require('../model/users.php');                                       // importing constructor class file
    require('../model/users_db.php');                                    // importing function file

$action = filter_input(INPUT_POST, 'action');                           // checking the value in action coming from post method

// for showing add user page if action is null

if ($action == NULL)                                                            
{
    $action = filter_input(INPUT_GET, 'action');                            // checking the value in action coming from get method
    if ($action == NULL)                                                        // nothing found in action
    {
        header('Location: add-user.php');
    }
}

// redirecting to add user page

if($action == 'addUsers')
{
    header('Location: add-user.php');
}

// inserting user information to the database

else if ($action == 'newUser')
{
    // form values
    $first_name = filter_input(INPUT_POST, 'first_name');                                        
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL); 
    $password = filter_input(INPUT_POST, 'password'); 
    if ($first_name == NULL || $last_name == NULL || $email == NULL || $email == FALSE || $password == NULL)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: add-user.php');                                                            // error message page
    }
    else
    {
        $crediential = new Users($first_name, $last_name, $email, $password,'','','');
        $chk_result = UsersDB::checkUserExist($crediential);                                    // check if user exist
        if($chk_result >= 1)
        {
          
            $_SESSION['error'] = "User with same email address already exist.";             // error message to be displayed
            header('Location: add-user.php');
        }
        else
        {
            $_SESSION['success'] = "User has been added successfully.";
            UsersDB::addUser($crediential);                                             // calling the function to add user
            header('Location: add-user.php');
        }
    }
}

// getting list of added users

elseif($action == 'manageUsers')
{
    $allusers = UsersDB::getUsersList();
    include('manage-users.php'); 
}

// unpublishing a user

elseif($action == 'deactivate')
{
    $id = filter_input(INPUT_POST, 'stat_id',FILTER_VALIDATE_INT);
    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageUsers');  
    }
    else
    {
        $table = 'user';
        $_SESSION['success'] = "User has been unpublished successfully.";
        UsersDB::deactivate($id,$table);                                        // calling the function
        header('Location: index.php?action=manageUsers');
    }
}

// publishing a user

elseif($action == 'activate')
{
    $id = filter_input(INPUT_POST, 'stat_id',FILTER_VALIDATE_INT);
    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageUsers');  
    }
    else
    {
        $table = 'user';
        $_SESSION['success'] = "User has been published successfully.";
        UsersDB::activate($id,$table);                                      // calling the function
        header('Location: index.php?action=manageUsers');
    }
}

// deleting a user

elseif($action == 'delete')
{
    $id = filter_input(INPUT_GET, 'del_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageUsers');  
    }
    else
    {
        $table = 'user';
        $_SESSION['success'] = "User has been deleted successfully.";
        UsersDB::delete($id,$table);                                            // calling the function
        header('Location: index.php?action=manageUsers');
    }
}

// get single user information

elseif($action == 'edit')
{
    $id = filter_input(INPUT_GET, 'edit_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageUsers');  
    }
    else
    {
        $userInfo = UsersDB::getUser($id);
        include('add-user.php');
    }
}

// updating user data

elseif($action == 'editUser')
{
    $id = filter_input(INPUT_POST, 'edit_id',FILTER_VALIDATE_INT);
    $first_name = filter_input(INPUT_POST, 'first_name');                                        
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL); 
    $password = filter_input(INPUT_POST, 'password'); 
    if ($first_name == NULL || $last_name == NULL || $email == NULL || $email == FALSE || $password == NULL || $id == FALSE || $id == NULL)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=edit&edit_id='.$id.'');  
    }
    else
    {
        $crediential = new Users($first_name, $last_name, $email, $password,$id,'','');
        UsersDB::editUser($crediential);                                                // calling the function
        $_SESSION['success'] = "User has been updated successfully.";
        header('Location: index.php?action=edit&edit_id='.$id.'');
    }
}

// viewing user information
elseif($action == 'viewUser')
{
    $id = filter_input(INPUT_GET, 'view_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: ../transactions/index.php?action=allTransaction');  
    }
    else
    {
        $userInfo = UsersDB::getUser($id);                                              // calling the function
        include('view-user.php');
    }
}

?>

