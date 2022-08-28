<?php
require_once "conn.php";

class Auth
{
    public static string $COOKIE_KEY = "wdc.login-auth";

    public static function createSession(int $id, int $expires = null): string
    {
        $token = self::randomStr();
        $ex = $expires ? "$expires" : "NULL";
        $sql = "INSERT INTO auth_session (user_id, token, expires) VALUE ($id, '$token', $ex)";
        $GLOBALS["conn"]->exec($sql);

        return $token;
    }

    public static function getSession(string $token): array
    {
        $sql = "SELECT * FROM auth_session WHERE token = '$token'";
        $result = $GLOBALS["conn"]->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    public static function deleteSession(string $token): void
    {
        $sql = "DELETE FROM auth_session WHERE token = '$token'";
        $GLOBALS["conn"]->exec($sql);
    }

    public static function getAuth(): array
    {
        $key = str_replace(".", "_", self::$COOKIE_KEY);
        $cookie = $_COOKIE[$key];
        $session = self::getSession($cookie);

        if (empty($session)) {
            return [];
        }

        $session = $session[0];
        $sql = "SELECT * FROM users WHERE id = {$session["user_id"]}";
        $result = $GLOBALS["conn"]->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $assoc = $result->fetchAll();

        return empty($assoc) ? [] : $assoc[0];
    }

    public static function getCookie()
    {
        $key = str_replace(".", "_", self::$COOKIE_KEY);

        return $_COOKIE[$key];
    }

    public static function isAuthenticate(bool $not = false)
    {
        $key = str_replace(".", "_", self::$COOKIE_KEY);

        if (!isset($_COOKIE[$key])) {
            return $not ? true : false;
        }

        $token = $_COOKIE[$key];
        $isAuth = !!sizeof(self::getSession($token));
        return $not ? !$isAuth : $isAuth;
    }

    public static function randomStr(int $length = 64): string
    {
        $str = "01234567890qazwsxedcfrvtgbyhnujmikolpQAZWSXEDCRFVTGBHNUJMIKKOLP";
        $res = [];

        for ($i = 0; $i < $length; $i++) {
            $res[$i] = $str[random_int(0, strlen($str) - 1)];
        }

        return join("", $res);
    }

    public static function setCookieSession(string $token, int $expires_time = null): void
    {
        setcookie(self::$COOKIE_KEY, $token, $expires_time, "/");
    }
}
