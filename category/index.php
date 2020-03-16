<?php
    require('../model/database.php');                                      // importing database connection file
    require('../model/category.php');                                       // importing constructor class file
    require('../model/category_db.php');                                    // importing function file

$action = filter_input(INPUT_POST, 'action');                                   // checking the value in action coming from post method

// showing add category page if action is null

if ($action == NULL)                                                            
{
    $action = filter_input(INPUT_GET, 'action');                                // checking the value in action coming from get method
    if ($action == NULL)                                                        // nothing found in action
    {  
        header('Location: add-category.php');
    }
}

// add category page
if($action == 'addCategory')
{
    header('Location: add-category.php');
}

// inserting a new category

else if ($action == 'newCategory')
{
    // form data

    $name = filter_input(INPUT_POST, 'name');                                        
    if ($name == NULL)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: add-category.php');                                                            // error message page
    }
    else
    {
        $crediential = new Category('',$name,'');
        $chk_result = CategoryDB::checkCategoryExist($crediential);  
        if($chk_result >= 1)
        {
          
            $_SESSION['error'] = "Category with same name already exist.";             // error message to be displayed
            header('Location: add-category.php');
        }
        else
        {
            $_SESSION['success'] = "Category has been added successfully.";
            CategoryDB::addCategory($crediential);
            header('Location: add-category.php');
        }
    }
}

// manage category page

elseif($action == 'manageCategory')
{
    $allcategorys = CategoryDB::getCategoryList();
    include('manage-category.php'); 
}

// unpublishing a category

elseif($action == 'deactivate')
{
    $id = filter_input(INPUT_POST, 'stat_id',FILTER_VALIDATE_INT);
    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageCategory');  
    }
    else
    {
        $table = 'category';
        $_SESSION['success'] = "Category has been unpublished successfully.";
        CategoryDB::deactivate($id,$table);
        header('Location: index.php?action=manageCategory');
    }
}

// publishing a category

elseif($action == 'activate')
{
    $id = filter_input(INPUT_POST, 'stat_id',FILTER_VALIDATE_INT);
    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageCategory');  
    }
    else
    {
        $table = 'category';
        $_SESSION['success'] = "Category has been published successfully.";
        CategoryDB::activate($id,$table);
        header('Location: index.php?action=manageCategory');
    }
}

// deleting a category

elseif($action == 'delete')
{
    $id = filter_input(INPUT_GET, 'del_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageCategory');  
    }
    else
    {
        $table = 'category';
        $_SESSION['success'] = "Category has been deleted successfully.";
        CategoryDB::delete($id,$table);
        header('Location: index.php?action=manageCategory');
    }
}

// form to edit category

elseif($action == 'edit')
{
    $id = filter_input(INPUT_GET, 'edit_id',FILTER_VALIDATE_INT);

    if($id == NULL || $id == FALSE)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=manageCategory');  
    }
    else
    {
        $categoryInfo = CategoryDB::getCategory($id);
        include('add-category.php');
    }
}

// editing a category

elseif($action == 'editCategory')
{
    // form values
    
    $id = filter_input(INPUT_POST, 'edit_id',FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name');                                        
    if ($name == NULL || $id == FALSE || $id == NULL)
    {
        $_SESSION['error'] = "Something went wrong. Please check your input(s).";
        header('Location: index.php?action=edit&edit_id='.$id.'');  
    }
    else
    {
        $crediential = new Category($id,$name,'');
        CategoryDB::editCategory($crediential);
        $_SESSION['success'] = "Category has been updated successfully.";
        header('Location: index.php?action=edit&edit_id='.$id.'');
    }
}

?>

