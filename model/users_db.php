<?php
class UsersDB {

    // check if user exist already

    public static function checkUserExist($crediential) {
        $db = Database::getDB();
        $email = $crediential->getemail();
        $query = 'SELECT * FROM user
                  WHERE email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();    
        $row = $statement->rowCount();
        $statement->closeCursor();
        return $row;
    }

    // inserting the user to the users table

    public static function addUser($crediential) {
        $db = Database::getDB();
        $first_name = $crediential->getFirstName();
        $last_name = $crediential->getLastName();
        $email = $crediential->getemail();
        $passwords = $crediential->getPassword();
        $query = 'INSERT INTO user
         (first_name, last_name, email, password)
      VALUES
         (:first_name, :last_name, :email, :passwords)';
        $statement = $db->prepare($query);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':passwords', $passwords);
        $statement->execute();
        $statement->closeCursor();
    }

    // getting user list

    public static function getUsersList() {
        $db = Database::getDB();
        $query = 'SELECT * FROM user
                  ORDER BY id ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $users = array();
        foreach ($statement as $row) {
            $user = new Users($row['first_name'], $row['last_name'],$row['email'],$row['password'],$row['id'],$row['date_time'],$row['status']);
            $users[] = $user;
        }
        return $users;
    }

    // unpublishing a user
    
    public static function deactivate($id,$table) {
        $db = Database::getDB();
        $query = 'UPDATE '.$table.' SET status = "0" WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // publishing a user

    public static function activate($id,$table) {
        $db = Database::getDB();
        $query = 'UPDATE '.$table.' SET status = "1" WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // deleting a user

    public static function delete($id,$table) {
        $db = Database::getDB();
        $query = 'DELETE FROM '.$table.' WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // getting individual user information

    public static function getUser($id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM user
                  WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $user = new Users($row['first_name'], $row['last_name'],$row['email'],$row['password'],$row['id'],'','');
        return $user;
    }

    // editing a user

    public static function editUser($crediential) {
        $db = Database::getDB();
        $first_name = $crediential->getFirstName();
        $last_name = $crediential->getLastName();
        $email = $crediential->getemail();
        $passwords = $crediential->getPassword();
        $id = $crediential->getID();
        $query = 'UPDATE user SET
            first_name = :first_name,
            last_name = :last_name,
            email = :email,
            password = :passwords
            WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':passwords', $passwords);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>