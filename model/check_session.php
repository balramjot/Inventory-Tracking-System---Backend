<?php
if(empty($_SESSION['admin']['username']) && !isset($_SESSION['admin']['username']))                             // checking if session exist for admin
{
    header('Location: ../login');
    exit;
}
?>