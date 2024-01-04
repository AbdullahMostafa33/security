<?php

use function PHPSTORM_META\type;

class CaesarCipher {
    private static  $letters = [];

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
        $cipher = '';
        foreach (str_split($text) as $char) {
            $p = array_search($char, self::$letters);
            $c = ($p + $key) % 95;
            $cipher .= self::$letters[$c];
        }
        return $cipher;
    }

    public function decode($cipher, $key) {
        $plainText = '';
        foreach (str_split($cipher) as $char) {
            $c = array_search($char, self::$letters);
            $p = ($c - $key) % 95;
            if ($p < 0) {
                $p += 95;
            }
            $plainText .= self::$letters[$p];
        }
        return $plainText;
    }
}

