#用法

```php
require('AESCrypt.php');

$crypt = new AESCrypt();

echo 'cipher text: ' . $crypt->encrypt('test');

$crypt->close();
```
