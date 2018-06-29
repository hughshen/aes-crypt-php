<?php

// Origin: encrypt string
// Encrypted: Hh2sjUUckvMQ2XsiPCVYgw==
// Decrypted: encrypt string

require('AESCrypt.php');

$crypt = new AESCrypt('UgkF1pOusN1KaZe5OaWA646Nw04DqPgE');

$text = 'encrypt string';
echo 'Origin: ' . $text . '<hr>';

$encrypted = $crypt->encrypt($text);
echo 'Encrypted: ' . $encrypted . '<hr>';

$decrypted = $crypt->decrypt($encrypted);
echo 'Decrypted: ' . $decrypted . '<hr>';

echo 'Current iv (base64_encode): ' . $crypt->getIv() . '<hr>';
