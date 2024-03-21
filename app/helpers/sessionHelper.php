<?php   
session_start();
class SessionHepler{
    public static function isLoggedIn(){
        return isset($_SESSION['username']);
    }
    public static function isAdmin(){
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
    public static function isUser(){
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user';
    }
}
?>