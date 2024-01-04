<?php
class VigenereCipher {
    private static $letters = [];

    public function __construct() {
        self::$letters = $this->makeLetters();
    }

    private function makeLetters() {
        $letters = [' '];
        for ($i = 1; $i <= 94; $i++)
         {
           $letters[$i] = chr($i +32);
         }
         return $letters;
    }

    public function encode($text, $key) {
        $keyRepeated = $this->repeatKey($text, $key);
        $cipher = '';

        for ($i = 0; $i < strlen($text); $i++) {
            $p = array_search($text[$i], self::$letters);
            $k = array_search($keyRepeated[$i], self::$letters);
            $c = ($p + $k) % 95;                  
            $cipher .= self::$letters[$c];
        }
        return $cipher;
    }

    public function decode($cipher, $key) {
        $keyRepeated = $this->repeatKey($cipher, $key);
        $plainText = '';

        for ($i = 0; $i < strlen($cipher); $i++) {
            $c = array_search($cipher[$i], self::$letters);
            $k = array_search($keyRepeated[$i], self::$letters);
            $p = ($c - $k) % 95;
            if ($p < 0) {
                $p += 95;
            }
            $plainText .= self::$letters[$p];
        }

        return $plainText;
    }

    private function repeatKey($text, $key) {
        $repeatedKey = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $repeatedKey .= $key[$i % strlen($key)];
        }
        return $repeatedKey;
    }
}
