<?php
namespace mtauth;

class MtAuthHelper
{
    static function customLoginFunction($username, $password, $remember = false) {
        $creds = array();
        $creds['user_login'] = $username;
        $creds['user_password'] = $password;
        $creds['remember'] = $remember;

        $user = wp_signon($creds, false);

        return $user;
    }

    public static function generateToken($length = 8, $chars = '1234567890') {
        $code = '';
        if (is_array($chars)) {
            $chars = implode('', $chars);
        }
        for ($i = 0; $i < $length; $i++) {
            $code .= substr($chars, wp_rand(0, strlen($chars) - 1), 1);
        }

        return $code;
    }

    public static function updateUserMeta($userId, $token) {
        update_user_meta($userId, MT_AUTH_PLUGIN_TOKEN, wp_hash($token));
        update_user_meta($userId, MT_AUTH_PLUGIN_TOKEN_TIMESTAMP, time());
    }

    public static function runTwoFaOption($userId, $email) {
        $token = self::generateToken();
        self::updateUserMeta($userId, $token);

        self::sendTwoFaMessage($email, $token);
    }

    public static function sendTwoFaMessage($email, $token) {
        $blogname = get_option('blogname');
        $subject = "New login to $blogname";
        $headers  = self::getEmailHeaders();
        $message = "$token is your $blogname code";

        $emailStatus = wp_mail($email, $subject, $message, $headers);
    }

    public static function getEmailHeaders() {
        $adminEmail = get_option('admin_email');

        $headers  = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'From: WordPress '.$adminEmail."\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";

        return $headers;
    }
}
