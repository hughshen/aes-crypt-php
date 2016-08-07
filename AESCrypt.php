<?php 

class AESCrypt
{
	public $text;
	public $result;

	private $key;
	private $iv;

	public function __construct($key = '')
	{
		if ($key == '') {
			$key = 'UgkF1pOusN1KaZe5OaWA646Nw04DqPgE';
		}

		// $key = base64_decode($key);

		$this->key = $key;
		$this->iv = substr($this->key, 0, 16);
	}

	// Encrypt
	public function encrypt()
	{
		$encrypter = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');

		$blockSize = mcrypt_enc_get_block_size($encrypter);
		$padding = $blockSize - strlen($this->text) % $blockSize;
		$paddingText = str_repeat(chr($padding), $padding);
		// Add padding text
		$paddedText = $this->text . $paddingText;

		mcrypt_generic_init($encrypter, $this->key, $this->iv);
		$encrypted = mcrypt_generic($encrypter, $paddedText);

		mcrypt_generic_deinit($encrypter);
		mcrypt_module_close($encrypter);

		$this->result = base64_encode($encrypted);
	}

	// Decrypt
	public function decrypt()
	{
		$originText = base64_decode($this->text);
		$encrypter = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');

		mcrypt_generic_init($encrypter, $this->key, $this->iv);
		$originText = mdecrypt_generic($encrypter, $originText);
		mcrypt_generic_deinit($encrypter);

		// Remove padding text
		$length = strlen($originText);
		$unpadding = ord($originText[$length - 1]);

		$this->result = substr($originText, 0, $length - $unpadding);
	}

	public function setText($text = '')
	{
		$this->text = $text;
	}
}

?>