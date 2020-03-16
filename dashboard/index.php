<?php
    require('../model/database.php');                                      // importing database connection file                                    // importing function file
    
$action = filter_input(INPUT_POST, 'action');                                   // checking the value in action coming from post method

// for dashboard page after successful login

if ($action == NULL)                                                            
{
    $action = filter_input(INPUT_GET, 'action');                                // checking the value in action coming from get method
    if ($action == NULL)                                                        // nothing found in action
    {  
        header('Location: dashboard.php');
    }
}

// for dashboard page after successful login

if ($action == 'dashboard')
{
    header('Location: dashboard.php');
}

?>

