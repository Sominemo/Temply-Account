<?php

class security {
    // Make variables and arrays secure and clear
    public static function filter($a) {
        if (!is_array($a) && is_string($a)) $r = security::clean($a);
        else $r = $a;

        foreach ($a as $k => $v) {
            $a[$k] = security::filter($v);
            if ($a[$k] === '') unset($a[$k]);
        }

        return $a;
    }

    // Make variables clear and correct
    public static function clean($a) {
        if ($a === "true" || $a === "false") $a = boolval($a); //BOOLify
        else if (is_numeric($a) && intval($a) == floatval($a)) $a = intval($a); //INTify
        else if (is_numeric($a)) $a = floatval($a); //FLOATify
        else if (is_string($a)) { //STRINGify
            $a = trim($a);
            $a = preg_replace("/  +/"," ",$a);
            $a = htmlspecialchars($a);
        }

        return $a;
    }

    public static function token_str($l = 64) {
        return bin2hex(random_bytes($l));
    }
}