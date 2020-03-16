<?php
class PartDB {
    
    // check if part exist in the database

	public static function checkPartExist($crediential) {
        $db = Database::getDB();
        $part_no = $crediential->getPartNo();
        $query = 'SELECT * FROM parts
                  WHERE part_no = :part_no';
        $statement = $db->prepare($query);
        $statement->bindValue(':part_no', $part_no);
        $statement->execute();    
        $row = $statement->rowCount();
        $statement->closeCursor();
        return $row;
    }

    // inserting a new part

    public static function addPart($crediential) {
        $db = Database::getDB();
        $category = $crediential->getCategoryID();
        $part_name = $crediential->getPartName();
        $part_no = $crediential->getPartNo();
        $description = $crediential->getDescription();
        $quantity = $crediential->getQuantity();

        if(!empty($_FILES['image']['name']))
		{
			$validextensions = array("jpeg", "jpg", "png", "gif");
			$ext = explode('.', basename($_FILES['image']['name']));
			$file_extension = end($ext);
			$filename = $_FILES['image']['name'];
			$file_target_path = "../uploads/" . $filename;

			if(in_array($file_extension, $validextensions)) 
			{
				if (move_uploaded_file($_FILES['image']['tmp_name'], $file_target_path))                                // uploading the image
				{
                    $filename = $filename;
                    $result = "1";
                }
                else
                {
                    $result = "2";
                    return $result;
                }
			}
			else
			{
                $result = "2";
                return $result;
			}
        }
        else
        {
            $filename = 'shkk44-113ki.png';
            $result = "1";
        }

       $query = 'INSERT INTO parts (category_id,part_name,part_no,description,quantity,image) VALUES (:category,:part_name,:part_no,:description,:quantity,:filename)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':part_name', $part_name);
        $statement->bindValue(':part_no', $part_no);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':filename', $filename);
        $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    // getting all parts list

    public static function getPartList() {
        $db = Database::getDB();
        $query = 'SELECT * FROM parts
                  ORDER BY id ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $parts = array();
        foreach ($statement as $row) {
            $category1 = CategoryDB::getCategory($row['category_id']);
            $category = $category1->getname();
            $part = new Part($row['id'], $category, $row['part_name'], $row['part_no'], $row['description'], $row['quantity'], $row['image'], $row['date_time'], $row['status']);
            $parts[] = $part;
        }
        return $parts;
    }

    // unpublishing a part

    public static function deactivate($id,$table) {
        $db = Database::getDB();
        $query = 'UPDATE '.$table.' SET status = "0" WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // publishing a part

    public static function activate($id,$table) {
        $db = Database::getDB();
        $query = 'UPDATE '.$table.' SET status = "1" WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // deleting a part

    public static function delete($id,$table) {
        $db = Database::getDB();
        $query = 'DELETE FROM '.$table.' WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // get single part

    public static function getPart($id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM parts
                  WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $category1 = CategoryDB::getCategory($row['category_id']);
        $category = $category1->getname();

        $part = new Part($row['id'], $category, $row['part_name'], $row['part_no'], $row['description'], $row['quantity'], $row['image'], $row['date_time'], $row['status']);
        return $part;
    }

    // editing a part

    public static function editPart($crediential) {
        $db = Database::getDB();
        $id = $crediential->getID();
        $category = $crediential->getCategoryID();
        $part_name = $crediential->getPartName();
        $part_no = $crediential->getPartNo();
        $description = $crediential->getDescription();
        $quantity = $crediential->getQuantity();
        $hidden_image = $crediential->getImageName();

        if(!empty($_FILES['image']['name']))
		{
			$validextensions = array("jpeg", "jpg", "png", "gif");
			$ext = explode('.', basename($_FILES['image']['name']));
			$file_extension = end($ext);
			$filename = $_FILES['image']['name'];
			$file_target_path = "../uploads/" . $filename;

			if(in_array($file_extension, $validextensions)) 
			{
				if (move_uploaded_file($_FILES['image']['tmp_name'], $file_target_path))                        // uploading the file
				{
                    $filename = $filename;
                    $result = "1";
                }
                else
                {
                    $result = "2";
                    return $result;
                }
			}
			else
			{
                $result = "2";
                return $result;
			}
        }
        else
        {
            $filename = $hidden_image;
            $result = "1";
        }

       $query = 'UPDATE parts SET category_id = :category,part_name = :part_name,part_no = :part_no,description = :description,quantity = :quantity,image = :filename WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':part_name', $part_name);
        $statement->bindValue(':part_no', $part_no);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':filename', $filename);
        $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    // searching a part

    public static function getSearchedPart($search) {
        $db = Database::getDB();
        if(!empty($search))
        {
            $query = 'SELECT * FROM parts
                  WHERE part_no LIKE "'.$search.'%"
                  OR part_name LIKE "'.$search.'%"
                  ORDER BY id ASC';
        }
        else
        {
            $query = 'SELECT * FROM parts
                  ORDER BY id ASC';
        }
        $statement = $db->prepare($query);
        $statement->execute();
        
        $parts = array();
        foreach ($statement as $row) {
            $category1 = CategoryDB::getCategory($row['category_id']);
            $category = $category1->getname();
            $part = new Part($row['id'], $category, $row['part_name'], $row['part_no'], $row['description'], $row['quantity'], $row['image'], $row['date_time'], $row['status']);
            $parts[] = $part;
        }
        return $parts;
    }

    // updating quantity from ajax function

    public static function updateQuantity($crediential) {
        $db = Database::getDB();
        $id = $crediential->getID();
        $quantity = $crediential->getQuantity();

       $query = 'UPDATE parts SET quantity = :quantity WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':quantity', $quantity);
        $statement->execute();
        $statement->closeCursor();
    }

    // getting out of stock parts list
    
    public static function getOutOfStockParts() {
        $db = Database::getDB();
        $query = 'SELECT * FROM parts
                  WHERE quantity <= 0
                  ORDER BY id ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $parts = array();
        foreach ($statement as $row) {
            $category1 = CategoryDB::getCategory($row['category_id']);
            $category = $category1->getname();
            $part = new Part($row['id'], $category, $row['part_name'], $row['part_no'], $row['description'], $row['quantity'], $row['image'], $row['date_time'], $row['status']);
            $parts[] = $part;
        }
        return $parts;
    }
}
?>