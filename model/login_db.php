<?php
class LoginDB {

    // check if admin exist in the database

    public static function checkAdmin($crediential) {
        $db = Database::getDB();
        $username = $crediential->getUsername();
        $passwords = $crediential->getPassword();
        $query = 'SELECT * FROM admin_login
                  WHERE username = :username
                  AND password = :passwords';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':passwords', $passwords);
        $statement->execute();    
        $row = $statement->rowCount();
        $statement->closeCursor();
        return $row;
    }

    // signing in the adminsitrator

    public static function adminLogin($crediential) {
        $db = Database::getDB();
        $username = $crediential->getUsername();
        $passwords = $crediential->getPassword();
        $query = 'SELECT * FROM admin_login
                  WHERE username = :username
                  AND password = :passwords';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':passwords', $passwords);
        $statement->execute();    
        $row = $statement->fetch();
        $statement->closeCursor();
        $logval = new Login($row['username'], $row['password']);
        $_SESSION['admin']['username'] = $logval->getUsername();                            // setting the session
    }

    
}
?>