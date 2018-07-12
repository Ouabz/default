<?php
class Functions {
    public static function AddressIP(){
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else {
            return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
        }
    }
    public static function Security($varialbe){
        $security = htmlspecialchars(trim(stripslashes(nl2br($varialbe))));
        return $security;

    }
    function isDeconnected(){
        if(!isset($_SESSION['email'])){
            header('Location: index.php');
        }
    }
}