#用法

```php
require('AESCrypt.php');

$crypt = new AESCrypt();

$text = 'encrypt string';

$crypt->setText($text);
$crypt->encrypt();

echo $crypt->result;
```
