<?php
    require('../model/database.php');                                      // importing database connection file
    require('../model/category.php');                                       // importing constructor class file
    require('../model/category_db.php');                                    // importing function file
    require('../model/part.php');                                           // importing constructor class file
    require('../model/part_db.php');                                        // importing function file

$action = filter_input(INPUT_POST, 'action');                                   // checking the value in action coming from post method

// add part if action is null

if ($action == NULL)                                                            
{
    $action = filter_input(INPUT_GET, 'action');                            // checking the value in action coming from get method
    if ($action == NULL)                                                        // nothing found in action
    {  
        $categorys = CategoryDB::getCategoryList();
        include('add-part.php');
    }
}

// add part initial page with empty fields

if($action == 'addPart')
{
    $categorys = CategoryDB::getCategoryList();
    include('add-part.php');
}

// inserting new part to the table

else if ($action == 'newPart')
{
    // form data

    $category = filter_input(INPUT_POST, 'category',FILTER_VALIDATE_INT);  
    $part_name = filter_input(INPUT_POST, 'part_name');  
    $part_no = filter_input(INPUT_POST, 'part_no');  
    $description = filter_input(INPUT_POST, 'description');
    $quantity = filter_input(INPUT_POST, 'quantity',FILTER_VALIDATE_INT);    

    if ($category == NULL || $category == FALSE || $part_no == NULL || $description == NULL || $quantity == NULL || $quantity == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        $categorys = CategoryDB::getCategoryList();
        include('add-part.php');
    }
    else
    {
        $categorys = CategoryDB::getCategoryList();
        $crediential = new Part('',$category,$part_name,$part_no,$description,$quantity,'','','');
        $chk_result = PartDB::checkPartExist($crediential);                     // check if part already exist
        if($chk_result >= 1)
        {
          
            $_SESSION['error'] = "Part with same part number already exist.";             // error message to be displayed
            include('add-part.php');
        }
        else
        {
            $output = PartDB::addPart($crediential);                                    // inserting the part function
            
            if($output == 1)
            {
                $_SESSION['success'] = "Part has been added successfully.";
            }
            else
            {
                $_SESSION['error'] = "Something went wrong. Please check uploaded file extension";
            }
            include('add-part.php');
        }
    }
}

// manage part page

elseif($action == 'managePart')
{
    $allparts = PartDB::getPartList();
    include('manage-part.php'); 
}

// unpublishing a part

elseif($action == 'deactivate')
{
    $id = filter_input(INPUT_POST, 'stat_id',FILTER_VALIDATE_INT);
    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=managePart');  
    }
    else
    {
        $table = 'parts';
        $_SESSION['success'] = "Part has been unpublished successfully.";
        CategoryDB::deactivate($id,$table);
        header('Location: index.php?action=managePart');
    }
}

// publishing a part

elseif($action == 'activate')
{
    $id = filter_input(INPUT_POST, 'stat_id',FILTER_VALIDATE_INT);
    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=managePart');  
    }
    else
    {
        $table = 'parts';
        $_SESSION['success'] = "Part has been published successfully.";
        CategoryDB::activate($id,$table);
        header('Location: index.php?action=managePart');
    }
}

// deleting a part

elseif($action == 'delete')
{
    $id = filter_input(INPUT_GET, 'del_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=managePart');  
    }
    else
    {
        $table = 'parts';
        $_SESSION['success'] = "Part has been deleted successfully.";
        CategoryDB::delete($id,$table);
        header('Location: index.php?action=managePart');
    }
}

// showing page to edit part

elseif($action == 'edit')
{
    $id = filter_input(INPUT_GET, 'edit_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $categorys = CategoryDB::getCategoryList();
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=managePart');  
    }
    else
    {
        $categorys = CategoryDB::getCategoryList();
        $partInfo = PartDB::getPart($id);
        include('add-part.php');
    }
}

// editing a part after form submit

elseif($action == 'editPart')
{
    // form values

    $edit_id = filter_input(INPUT_POST, 'edit_id');
    $category = filter_input(INPUT_POST, 'category',FILTER_VALIDATE_INT);  
    $part_name = filter_input(INPUT_POST, 'part_name');  
    $part_no = filter_input(INPUT_POST, 'part_no');  
    $description = filter_input(INPUT_POST, 'description');
    $quantity = filter_input(INPUT_POST, 'quantity',FILTER_VALIDATE_INT);
    $hidden_image = filter_input(INPUT_POST, 'hidden_image');
    
    if ($category == NULL || $category == FALSE || $part_no == NULL || $description == NULL || $quantity == NULL || $quantity == FALSE || $edit_id == FALSE || $edit_id == NULL)
    {
        $categorys = CategoryDB::getCategoryList();
        $_SESSION['error'] = "Something went wrong. Please check your input(s)ss.";
        header('Location: index.php?action=edit&edit_id='.$id.'');  
    }
    else
    {
        $categorys = CategoryDB::getCategoryList();
        $crediential = new Part($edit_id,$category,$part_name,$part_no,$description,$quantity,$hidden_image,'','');
        $output = PartDB::editPart($crediential);

        if($output == 1)
        {
            $_SESSION['success'] = "Part has been added successfully.";
        }
        else
        {
            $_SESSION['error'] = "Something went wrong. Please check uploaded file extension";
        }
        header('Location: index.php?action=edit&edit_id='.$edit_id.'');
    }
}

// changing part quantity from ajax

elseif($action == 'changeQuantityAjax')
{
   $edit_id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
   $quantity = filter_input(INPUT_POST, 'quantity',FILTER_VALIDATE_INT);  
   if ($edit_id == NULL || $edit_id == FALSE ||  $quantity == FALSE || $quantity == NULL)
    {
        $result = '2';
        echo  $result;
    }
    else
    {
        $crediential = new Part($edit_id,'','','','',$quantity,'','','');
        PartDB::updateQuantity($crediential);
        $result = '1';
        echo $result;
    }
}

// viewing a particular part

elseif($action == 'viewPart')
{
    $id = filter_input(INPUT_GET, 'view_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: ../transactions/index.php?action=allTransaction'); 
    }
    else
    {
        $categorys = CategoryDB::getCategoryList();
        $partInfo = PartDB::getPart($id);
        include('view-part.php');
    }
}

// showing out of stock items

elseif($action == 'outOfStock')
{
    $id = filter_input(INPUT_GET, 'view_id',FILTER_VALIDATE_INT);

    $outofstockparts = PartDB::getOutOfStockParts();
    include('out-of-stock.php'); 
}

?>

