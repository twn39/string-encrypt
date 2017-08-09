<?php
namespace Monster;

class StringEncrypt
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $iv;
    /**
     * @var string
     * http://php.net/manual/zh/function.openssl-get-cipher-methods.php
     */
    private $method;

    /**
     * StringEncrypt constructor.
     * @param string $method
     */
    public function __construct($method = "AES-256-CFB")
    {
        $this->method = $method;
    }

    /**
     * @param $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setIv($iv)
    {
        $ivLen = openssl_cipher_iv_length($this->method);
        $this->iv = $ivLen === strlen($iv)
            ? $iv
            : base64_decode($iv);
    }

    /**
     * @param $cipher
     */
    public function setCipher($cipher)
    {
        $this->method = $cipher;
    }

    /**
     * @param $data
     * @return string
     */
    public function encrypt($data)
    {
        return openssl_encrypt($data, $this->method, $this->key, 0, $this->iv);
    }

    /**
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        return openssl_decrypt($data, $this->method, $this->key, 0, $this->iv);
    }

    /**
     * @return string
     */
    public function createBase64EncodeIv()
    {
        $ivLen = openssl_cipher_iv_length($this->method);
        return base64_encode(openssl_random_pseudo_bytes($ivLen));
    }
}
