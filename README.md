## 用法

```php
require('AESCrypt.php');

$crypt = new AESCrypt('your_key');
echo 'cipher text: ' . $crypt->encrypt('test');
```