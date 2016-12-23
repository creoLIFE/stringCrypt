<?php
namespace creoLIFE\Helper;

class StringCryptSimple
{
    /**
     * @var string
     */
    protected $encriptionKey;

    /**
     * @return string
     */
    public function getEncriptionKey()
    {
        return $this->encriptionKey;
    }

    /**
     * @param string $encriptionKey
     */
    public function setEncriptionKey($encriptionKey)
    {
        $this->encriptionKey = $encriptionKey;
    }

    /**
     * StringCrypt constructor.
     * @param $encriptionKey
     * @throws Exception
     */
    public function __construct($encriptionKey)
    {
        $this->encriptionKey = md5($encriptionKey);
    }

    /**
     * Method will encrypt given text
     * @param $string
     * @return string
     */
    public function encrypt($string)
    {
        return base64_encode(
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_256,
                $this->encriptionKey,
                $string,
                MCRYPT_MODE_CBC,
                md5(
                    $this->encriptionKey
                )
            )
        );
    }

    /**
     * Method will decode encrypted text
     * @param string $string
     * @return bool|mixed|string
     */
    function decrypt($string)
    {
        return rtrim(
            mcrypt_decrypt(
                MCRYPT_RIJNDAEL_256,
                $this->encriptionKey,
                base64_decode($string),
                MCRYPT_MODE_CBC,
                md5(
                    $this->encriptionKey
                )
            ),
            "\0"
        );
    }
}
