<?php
ERROR_REPORTING(E_ALL);
require_once(__DIR__ . '/../src/loader.php');
use creoLIFE\Helper\StringCryptUnique;
use creoLIFE\Helper\StringCryptSimple;

$someString = "Some nice text to encrypt/decrypt !";

$stringCrypt = new StringCryptUnique('d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca28a');
$encrypted = $stringCrypt->encrypt($someString);

var_export( $someString );
echo "<br><br>";
var_export( $encrypted );
echo "<br><br>";
var_export( $stringCrypt->decrypt($encrypted) );


$stringCrypt = new StringCryptUnique('ssfsf6sdf9sdfdf22d5fges5vg4rl3s8');
$encrypted = $stringCrypt->encrypt($someString);

echo "<br><br>";
var_export( $encrypted );
echo "<br><br>";
var_export( $stringCrypt->decrypt($encrypted) );



$stringCrypt = new StringCryptSimple('somehashtext');
$encrypted = $stringCrypt->encrypt($someString);

echo "<br><br>";
var_export( $encrypted );
echo "<br><br>";
var_export( $stringCrypt->decrypt($encrypted) );
