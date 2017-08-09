## 说明

此加密方式用来加密手机号或身份证号，对因某种漏洞而被人拖库时对手机号和身份证号提供基本的安全保护。
不能用此加密方式来加密密码，因手机号和身份证号存储在数据库中，而且必须提供解密方式，为了查询方便，采用固定IV，
因此相对于默认的随机iv的aes加密的安全性更低，所以这是一种折中的方式。
也切勿使用这种方式加密文件。

## 使用方式

```php
$stringEncrypt = new \Monster\StringEncrypt();
$stringEncrypt->setKey("123456");
$base64EncodeIv = $stringEncrypt->createBase64EncodeIv();
$stringEncrypt->setIv($base64EncodeIv);
$data = $stringEncrypt->encrypt("18358274773");
$stringEncrypt->decrypt($data);
```