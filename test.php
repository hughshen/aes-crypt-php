<?php

// Origin: encrypt string
// Encrypted: Hh2sjUUckvMQ2XsiPCVYgw==
// Decrypted: encrypt string

require('AESCrypt.php');

$crypt = new AESCrypt();

$text = 'encrypt string';
echo 'Origin: ' . $text . '<hr>';

$encrypted = $crypt->encrypt($text);
echo 'Encrypted: ' . $encrypted . '<hr>';

$decrypted = $crypt->decrypt($encrypted);
echo 'Decrypted: ' . $decrypted . '<hr>';

$crypt->close();