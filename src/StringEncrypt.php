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
    private $cipher;

    /**
     * StringEncrypt constructor.
     * @param string $cipher
     */
    public function __construct($cipher = "AES-256-CFB")
    {
        $this->cipher = $cipher;
    }

    public function getCipher()
    {
        return $this->cipher;
    }

    /**
     * @param $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $iv
     */
    public function setIv($iv)
    {
        $ivLen = openssl_cipher_iv_length($this->cipher);
        $this->iv = $ivLen === strlen($iv)
            ? $iv
            : base64_decode($iv);
    }

    /**
     * @param $cipher
     */
    public function setCipher($cipher)
    {
        $this->cipher = $cipher;
    }

    /**
     * @param $data
     * @return string
     */
    public function encrypt($data)
    {
        return openssl_encrypt($data, $this->cipher, $this->key, 0, $this->iv);
    }

    /**
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        return openssl_decrypt($data, $this->cipher, $this->key, 0, $this->iv);
    }

    /**
     * @return string
     */
    public function createBase64EncodeIv()
    {
        $ivLen = openssl_cipher_iv_length($this->cipher);
        return base64_encode(openssl_random_pseudo_bytes($ivLen));
    }
}
