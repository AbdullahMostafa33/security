<?php 
class AffineCipher {
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

    private function gcd($n, $a) {
        if ($a == 0) {
            return $n;
        }
        return $this->gcd($a, $n % $a);
    }

    public function encode($msg, $a, $b) {
        if ($this->gcd(95, $a) == 1) {
            $cipher = "";
            for ($i = 0; $i < strlen($msg); $i++) {
                $p = array_search($msg[$i], self::$letters);
                $index = (($a * $p) + $b) % 95;
                $cipher .= self::$letters[$index];
            }
            return $cipher;
        } else {
            return "Invalid key (a) not relatively prime";
        }
    }

    public function decode($cipher, $a, $b) {
        if ($this->gcd(95, $a) == 1) {
            $msg = "";
            $a_inv = 0;
            $flag = 0;
            for ($i = 0; $i < 95; $i++) {
                $flag = ($a * $i) % 95;
                if ($flag == 1) {
                    $a_inv = $i;
                }
            }
            for ($i = 0; $i < strlen($cipher); $i++) {
                $c = array_search($cipher[$i], self::$letters);
                $index = (($a_inv * ($c - $b)) % 95);
                if ($index < 0) {
                    $index += 95;
                }
                $msg .= self::$letters[$index];
            }
            return $msg;
        } else {
            return "Invalid key (a) not relatively prime";
        }
    }
}

