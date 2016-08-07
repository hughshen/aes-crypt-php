<?php

require('AESCrypt.php');

$crypt = new AESCrypt();

$text = 'encrypt string';
echo 'Origin: ' . $text . '<hr>';

$crypt->setText($text);
$crypt->encrypt();
$encrypted  = $crypt->result;

echo 'Encrypted: ' . $encrypted . '<hr>';

$crypt->setText($encrypted);
$crypt->decrypt();
$decrypted = $crypt->result;

echo 'Decrypted: ' . $decrypted . '<hr>';