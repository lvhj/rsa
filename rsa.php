
<?php
ini_set('error_reporting', -1);
ini_set('display_errors', -1);
header('Content-Type: text/html; charset=utf-8');
# openssl genrsa -out rsa_private_key.pem 1024
# openssl rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem
$private_key = "
-----BEGIN RSA PRIVATE KEY-----
MIICXwIBAAKBgQDd0+2AlzD1atNfgdZqSS4LPc8rUMLqjY0qrFFScEutMdikQmge
6IP6M4p2FFZf9FHiaCuPQ8e7x/dW/N4Ax5baFSzwJhzx7SpxcKKAJRQaXrjEKCCT
bOwDyZGXfskJqZkkAuFoS1yeyRDM33PjQxG5rlidmztuZvYSaBsknZmjoQIDAQAB
AoGBAJiFb+abjgEgO0eO2WNo/6yhCgHJXMuzGh3+L0gUiCQEguWl9ztROfVdXNWF
dEIzld2rLFAsFXfqrQj1gptcoD34pwkHaUdtEzFxCZXGtuzjA2zwJm45VcNEx173
hozdPEmjQSQkV/DVdjc5widKygq5EfaQB8ypIjaPC87dWXtVAkEA9zhkqGaEz32H
VAD+iE9m4Tlnd8DTHl2vJZyOCA99j/X0Tz65Ohd1nl5ltfY8Zf6zKt3IboPzSejj
DcdYjmoQTwJBAOW0rcTRDJihP4KYwK1zNO5F4sGL0WuAb8sgFbOeVnztPFPxXEF2
lJiDkyEBtH45mQlWCDV1QFp0WfXUqfuPoQ8CQQDB3LcSV1JOY2F7vkvbGGjUtO8u
OUdUyKJQHDREneEYwwaSHd2icEMLrXqU9kLmuJRHSSOjhlWB394tL+WByCqBAkEA
q15xKV2AlTnvRMIrNPu3KHAw7I4gDaCDRrpIFnnxMkBW+pUda6VI1MOMd1prSqQz
3Pg3JZK1EQauuq0Op6OO1wJBAIq5V2leTdPwGW9Hyj5ulwcCLD6kOTAf9ctRIC5J
kzHPIbzULoagp/TZmumKVcRsjTnwilRDOUKfW7yg/HDCGRI=
-----END RSA PRIVATE KEY-----
";
//$private_key = file_get_contents("/home/redredmaple/test/rsa_private_key.pem");

$public_key = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDd0+2AlzD1atNfgdZqSS4LPc8r
UMLqjY0qrFFScEutMdikQmge6IP6M4p2FFZf9FHiaCuPQ8e7x/dW/N4Ax5baFSzw
Jhzx7SpxcKKAJRQaXrjEKCCTbOwDyZGXfskJqZkkAuFoS1yeyRDM33PjQxG5rlid
mztuZvYSaBsknZmjoQIDAQAB
-----END PUBLIC KEY-----";
//$public_key = file_get_contents("/home/redredmaple/test/rsa_public_key.pem");
$pi_key =  openssl_pkey_get_private($private_key);// 可用返回资源id
$pu_key = openssl_pkey_get_public($public_key);
// 加密数据
$data = array(
    'id' => '1234567890',
    'name' => '小明',
    'mobile' => '123456',
);
$data = json_encode($data);
$encrypted = '';
$decrypted = '';
#openssl_public_encrypt($data, $encrypted, $pu_key);//公钥加密
#$encrypted = base64_encode($encrypted);// base64传输
#openssl_private_decrypt(base64_decode($encrypted), $decrypted, $pi_key);//私钥解密
#print_r(json_decode($decrypted, true));
openssl_private_encrypt($data, $encrypted, $pi_key);//公钥加密
$encrypted = base64_encode($encrypted);// base64传输
openssl_public_decrypt(base64_decode($encrypted), $decrypted, $pu_key);//私钥解密
print_r(json_decode($decrypted, true));