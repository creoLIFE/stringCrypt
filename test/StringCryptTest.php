<?php
ERROR_REPORTING(E_ALL);
require_once(__DIR__ . '/../src/loader.php');

use creoLIFE\Helper\StringCrypt;

class stringCryptTest extends PHPUnit_Framework_TestCase
{
    const STRINGCRYPT_KEY = 'asid87dfbos7vtbisa87bdfi67rbsd7v';

    public function testEncodeDecode()
    {
        $someString = "Some nice text to encrypt/decrypt !";

        $stringCrypt = new StringCrypt(self::STRINGCRYPT_KEY);
        $encrypted = $stringCrypt->encrypt($someString);

        $this->assertEquals($stringCrypt->decrypt($encrypted), $someString);
    }

}
