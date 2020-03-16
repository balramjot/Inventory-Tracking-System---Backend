<?php
    require('model/database.php');                                      // importing database connection file
    require('model/login.php');                                       // importing constructor class file
    require('model/login_db.php');                                    // importing function file
    
$action = filter_input(INPUT_POST, 'action');                                   // checking the value in action coming from post method

// for showing admin login page

if ($action == NULL)                                                            
{
    $action = filter_input(INPUT_GET, 'action');                                // checking the value in action coming from get method
    if ($action == NULL)                                                        // nothing found in action
    {
        header('Location: login');
    }
}

// admin login

if ($action == 'login')
{
    $username = filter_input(INPUT_POST, 'username');                                         // assigning username post value to variable
    $password = filter_input(INPUT_POST, 'password');                                      // assigning password post value to variable

    if ($username == NULL || $password == NULL)                                                // validating that values must not be empty
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";                           // error message to be displayed
        header('Location: login');
    }
    else
    {
          $crediential = new Login($username, $password);
          $chk_result = LoginDB::checkAdmin($crediential);  
          if($chk_result >= 1)
          {
            LoginDB::adminLogin($crediential);                                               // calling function to login admin
            header('Location: dashboard/index.php?action=dashboard');
          }
          else
          {
            $_SESSION['error'] = "Please check your username or password.";             // error message to be displayed
            header('Location: login');
          }
    }
}
?>

