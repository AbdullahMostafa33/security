<?php
include("algorithms/caesar.php");
include("algorithms/viginire.php");
include("algorithms/autokey.php");
include("algorithms/affine.php");

$text = isset($_GET['text']) ? $_GET['text'] :"";
$key=isset($_GET['key']) ? $_GET['key'] :"";
$key2=isset($_GET['key2']) ? $_GET['key2'] :"";

switch ($_GET['select']) {
    case "caesar":
        $ciper=new CaesarCipher();
        if ($_GET['type']=="encrypt_button")$result=$ciper->encode($text,(int)$key);
        else $result=$ciper->decode($text,(int)$key);
        break;

    case "viginire":
        $ciper=new VigenereCipher();
        if ($_GET['type']=="encrypt_button")$result=$ciper->encode($text,$key);
        else $result=$ciper->decode($text,$key);
        break;
    
    case "autoKey":
        $ciper=new AutoKeyCipher();
        if ($_GET['type']=="encrypt_button")$result=$ciper->encode($text,$key);
        else $result=$ciper->decode($text,$key);
        break;
    
    case "affine":
        $ciper=new AffineCipher();
        if ($_GET['type']=="encrypt_button")$result=$ciper->encode($text,(int)$key,(int)$key2);
        else $result=$ciper->decode($text,(int)$key,(int)$key2);
        break;
    
    
    default:
        $result="problem in select";
}

echo $result;