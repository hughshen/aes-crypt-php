<?php 

class AESCrypt
{
	private $key;
	private $iv;
	private $encrypter;

	public function __construct($key = '', $algorithm = MCRYPT_RIJNDAEL_128, $mode = MCRYPT_MODE_ECB)
	{
		if ($key == '') {
			$key = 'UgkF1pOusN1KaZe5OaWA646Nw04DqPgE';
		}

		// $key = base64_decode($key);

		$this->key = $key;
		$this->iv = substr($this->key, 0, 16);
		$this->encrypter = mcrypt_module_open($algorithm, '', $mode, '');
	}

	// Encrypt
	public function encrypt($originText) {
		$originText = $this->pkcs5padding($originText, mcrypt_enc_get_block_size($this->encrypter));
		mcrypt_generic_init($this->encrypter, $this->key, $this->iv);
		$cipherText = mcrypt_generic($this->encrypter, $originText);
		mcrypt_generic_deinit($this->encrypter);
		return base64_encode($cipherText);
	}

	// Decrypt
	public function decrypt($cipherText) {
		$cipherText = base64_decode($cipherText);
		mcrypt_generic_init($this->encrypter, $this->key, $this->iv);
		$originText = mdecrypt_generic($this->encrypter, $cipherText);
		mcrypt_generic_deinit($this->encrypter);
		return $this->pkcs5unPadding($originText);
	}

	public function close() {
		mcrypt_module_close($this->encrypter);
	}

	private function pkcs5padding($text, $blockSize) {
		$padding = $blockSize - strlen($text) % $blockSize;
		$paddingText = str_repeat(chr($padding), $padding);
		return $text . $paddingText;
	}

	private function pkcs5unPadding($text) {
		$length = strlen($text);
		$unpadding = ord($text[$length - 1]);
		return substr($text, 0, $length - $unpadding);
	}
}

?>