<?php

class AESCrypt
{
    private $key;
    private $iv;
    private $method;
    private $options;

    public function __construct($key, $method = 'AES-256-ECB', $iv = null, $options = OPENSSL_RAW_DATA)
    {
        if ($iv === null) {
            $ivlen = openssl_cipher_iv_length($method);
            $iv = openssl_random_pseudo_bytes($ivlen);
        }

        $this->key = $key;
        $this->iv = $iv;
        $this->method = $method;
        $this->options = $options;
    }

    // Encrypt
    public function encrypt($originText)
    {
        $cipherText = openssl_encrypt($originText, $this->method, $this->key, $this->options, $this->iv);
        return base64_encode($cipherText);
    }

    // Decrypt
    public function decrypt($cipherText)
    {
        return openssl_decrypt(base64_decode($cipherText), $this->method, $this->key, $this->options, $this->iv);
    }

    // Get iv
    public function getIv($encode = true)
    {
        return $encode ? base64_encode($this->iv) : $this->iv;
    }
}
