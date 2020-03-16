<?php
class TransactionDB {

    // getting all transaction list

    public static function getTransactionList() {
        $db = Database::getDB();
        $query = 'SELECT user_id FROM transaction
                  GROUP BY user_id';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $transactions = array();
        foreach ($statement as $row) {
            $user = UsersDB::getUser($row['user_id']);
            $username = $user->getFirstName().' '.$user->getLastName();
            $total_trans1 = TransactionDB::getTransactionUser($row['user_id']);
            $total_trans = $total_trans1->gettotal_trans();
            $transaction = new Transaction($row['id'], $row['user_id'],$username,$row['part_id'],$total_trans, $row['status']);
            $transactions[] = $transaction;
        }
        return $transactions;
    }

    // get transaction according to user

    public static function getTransactionUser($userid) {
        $db = Database::getDB();
        $query = 'SELECT * FROM transaction
                  WHERE user_id = :userid';
        $statement = $db->prepare($query);
        $statement->bindValue(":userid", $userid);
        $statement->execute();
        $row = $statement->rowCount();
        $statement->closeCursor();
        $transaction = new Transaction('', '','','',$row, '');
        return $transaction;
    }

    // get transaction with users list

    public static function getTransactionUserList($userid) {
        $db = Database::getDB();
        $query = 'SELECT * FROM transaction
                  WHERE user_id = :userid';
        $statement = $db->prepare($query);
        $statement->bindValue(":userid", $userid);
        $statement->execute();
        $userslist = array();
        foreach ($statement as $row) {
            $user = UsersDB::getUser($row['user_id']);
            $username = $user->getFirstName().' '.$user->getLastName();
            $partnames = PartDB::getPart($row['part_id']);
            $partname = $partnames->getPartName();
            $userslists = new Transaction($row['id'], $partname,$username,$row['part_id'],$row['quantity'], $row['date_time']);
            $userslists->setStatus($row['status']);
            $userslist[] = $userslists;
        }
        return $userslist;
    }

    // deleting a transaction

    public static function delete($id,$table) {
        $db = Database::getDB();
        $query = 'DELETE FROM '.$table.' WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // mark transaction as read

    public static function deactivate($id,$table) {
        $db = Database::getDB();
        $query = 'UPDATE '.$table.' SET status = "0" WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // changing quantity for the header notification
    
    public static function subtractQuantity() {
        $db = Database::getDB();
        $query = 'SELECT * FROM transaction
                  WHERE status = "1"';
        $statement = $db->prepare($query);
        $statement->execute();
        $row = $statement->rowCount();
        $statement->closeCursor();
        return $row;
    }
}
?>