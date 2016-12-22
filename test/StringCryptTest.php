<?php
ERROR_REPORTING(E_ALL);
require_once(__DIR__ . '/../src/loader.php');

use creoLIFE\Helper\StringCryptUnique;
use creoLIFE\Helper\StringCryptSimple;

class stringCryptTest extends PHPUnit_Framework_TestCase
{
    const STRINGCRYPT_KEY_UNIQUE = 'asid87dfbos7vtbisa87bdfi67rbsd7v';
    const STRINGCRYPT_KEY_SIMPLE = 'siabti8a7tsfvai';

    public function testEncodeDecodeUnique()
    {
        $someString = "Some nice text to encrypt/decrypt !";

        $stringCrypt = new StringCryptUnique(self::STRINGCRYPT_KEY_UNIQUE);
        $encrypted = $stringCrypt->encrypt($someString);

        $this->assertEquals($stringCrypt->decrypt($encrypted), $someString);
    }

    public function testEncodeDecodeSimple()
    {
        $someString = "Some nice text to encrypt/decrypt !";

        $stringCrypt = new StringCryptSimple(self::STRINGCRYPT_KEY_SIMPLE);
        $encrypted = $stringCrypt->encrypt($someString);

        $this->assertEquals($stringCrypt->decrypt($encrypted), $someString);
    }

}
