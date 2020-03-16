<?php
class CategoryDB {

    // check if category exist

    public static function checkCategoryExist($crediential) {
        $db = Database::getDB();
        $name = $crediential->getname();
        $query = 'SELECT * FROM category
                  WHERE name = :name';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();    
        $row = $statement->rowCount();
        $statement->closeCursor();
        return $row;
    }

    // inserting a new category

    public static function addCategory($crediential) {
        $db = Database::getDB();
        $name = $crediential->getname();
        $query = 'INSERT INTO category (name) VALUES (:name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();
    }

    // getting category list

    public static function getCategoryList() {
        $db = Database::getDB();
        $query = 'SELECT * FROM category
                  ORDER BY id ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $categorys = array();
        foreach ($statement as $row) {
            $category = new Category($row['id'], $row['name'],$row['status']);
            $categorys[] = $category;
        }
        return $categorys;
    }

    // unpublishing a category

    public static function deactivate($id,$table) {
        $db = Database::getDB();
        $query = 'UPDATE '.$table.' SET status = "0" WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // publishing a category

    public static function activate($id,$table) {
        $db = Database::getDB();
        $query = 'UPDATE '.$table.' SET status = "1" WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // deleting a category

    public static function delete($id,$table) {
        $db = Database::getDB();
        $query = 'DELETE FROM '.$table.' WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // get a single category

    public static function getCategory($id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM category
                  WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $category = new Category($row['id'], $row['name'],'');
        return $category;
    }

    // editing a category

    public static function editCategory($crediential) {
        $db = Database::getDB();
        $name = $crediential->getname();
        $id = $crediential->getID();
        $query = 'UPDATE category SET
            name = :name
            WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>