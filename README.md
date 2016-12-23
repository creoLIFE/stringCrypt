# stringCrypt

## PHP library to encrypt/decrypt strings using Rijndael-256, MCrypt with Cipher Block Chaining (CBC) mode.

## Usage

### Unique encoded key version
```
use creoLIFE\Helper\StringCryptSimple;

$someString = "Some nice text to encrypt/decrypt !";

$stringCrypt = new StringCryptUnique('d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca28a');
$encrypted = $stringCrypt->encrypt($someString);
$decrypted = $stringCrypt->decrypt($encrypted);
```

### Simple static encoded key version
```
use creoLIFE\Helper\StringCryptSimple;

$someString = "Some nice text to encrypt/decrypt !";

$stringCrypt = new StringCryptSimple('some_hashing_text');
$encrypted = $stringCrypt->encrypt($someString);
$decrypted = $stringCrypt->decrypt($encrypted);
```
