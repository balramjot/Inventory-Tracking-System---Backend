<?php
class LogoutDB {

    // logout function for admin

    public static function adminLogout() {
        $db = Database::getDB();
        unset($_SESSION['admin']['username']);                          // unsetting session
        session_destroy();
    }
}
?>