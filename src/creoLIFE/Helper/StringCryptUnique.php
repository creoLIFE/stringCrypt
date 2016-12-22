<?php
namespace creoLIFE\Helper;

class StringCryptUnique
{
    const DELIMETER = '|';

    /**
     * @var string
     */
    protected $encriptionKey;

    /**
     * StringCrypt constructor.
     * @param $encriptionKey
     * @throws Exception
     */
    public function __construct($encriptionKey)
    {
        $kLength = strlen($encriptionKey);
        if ($kLength !== 32 && $kLength !== 64) {
            throw new \Exception('The encription key MUST have length of 32 or 64 characters');
        }
        $this->encriptionKey = $encriptionKey;
    }

    /**
     * Method will encrypt given text
     * @param $string
     * @return string
     */
    public function encrypt($string)
    {
        $serializedString = serialize($string);
        $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC),
            MCRYPT_DEV_URANDOM
        );
        $key = @pack('H*', $this->encriptionKey);
        $mac = hash_hmac('sha256', $serializedString, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(
            MCRYPT_RIJNDAEL_256,
            $key,
            sprintf('%s%s', $serializedString, $mac),
            MCRYPT_MODE_CBC,
            $iv
        );

        return sprintf(
            '%s%s%s',
            base64_encode($passcrypt),
            self::DELIMETER,
            base64_encode($iv)
        );
    }

    /**
     * Method will decode encrypted text
     * @param string $string
     * @return bool|mixed|string
     */
    function decrypt($string)
    {
        $explodedString = explode(
            self::DELIMETER,
            sprintf(
                '%s%s',
                $string,
                self::DELIMETER
            )
        );
        $decodedString = base64_decode($explodedString[0]);
        $iv = base64_decode($explodedString[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = @pack('H*', $this->encriptionKey);
        $decrypted = trim(mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256,
            $key,
            $decodedString,
            MCRYPT_MODE_CBC,
            $iv
        ));
        $mac = substr($decrypted, -64);
        $finalString = substr($decrypted, 0, -64);
        $calcmac = hash_hmac(
            'sha256',
            $finalString,
            substr(bin2hex($key), -32)
        );
        if ($calcmac !== $mac) {
            return false;
        }

        return unserialize($finalString);
    }
}
