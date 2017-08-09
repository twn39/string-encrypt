<?php

namespace spec\Monster;

use Monster\StringEncrypt;
use PhpSpec\ObjectBehavior;

class StringEncryptSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(StringEncrypt::class);
    }

    public function let()
    {
        $this->beConstructedWith("AES-256-CFB");
    }

    public function it_should_return_cipher_key()
    {
        $this->getCipher()->shouldReturn("AES-256-CFB");
    }

    public function it_should_return_right_key()
    {
        $this->setKey("123456");
        $this->getKey()->shouldReturn("123456");
    }

    public function it_should_return_right_iv()
    {
        $this->createBase64EncodeIv()->shouldBeString();
    }

    public function it_should_encrypt_and_can_decrypt()
    {
        $this->setKey("123456");
        $iv = $this->createBase64EncodeIv();
        $this->setIv($iv);
        $encryptData = $this->encrypt("phone");
        $this->decrypt($encryptData)->shouldReturn("phone");
    }
}
