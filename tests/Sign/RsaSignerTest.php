<?php
namespace tests\Sign;

use PHPUnit\Framework\TestCase;
use Gamemoney\Sign\SignerInterface;
use Gamemoney\Sign\Signer\RsaSigner;

class RsaSignerTest extends TestCase {

    private $privateKey;

    protected function setUp()
    {
        $this->privateKey = $this->getPrivateKey();
    }

    public function testInterface() {
        $Signer = new RsaSigner($this->privateKey);
        $this->isInstanceOf($Signer, SignerInterface::class);
    }

    public function testRsaGetSignature() {
        $fixture = 'wWImA3n2RkUMZyQJL9CH86htz20ykU7NLLJT2sMYHcZgFu7CZriLpcdeQXL9IuikrpweogEuBrobmKezxn3++8aik6PDX4m21cYv50yxKRmPwrVN3t8IrHNchXNS6yDEFlhxqrJMXyBMOV/Dr2f0EoBpJCCe8NXxWlzrDo0H0YnfbBA4OhzGnSbX3Kzd0tcqLI/v8UllmwGYxAoryV3mpHAx5XsTLW3ws1imx5u97AL5UP+3V/iOOqeAj/+Yp/GnWpV3f/OdwSeddGRBvyGnMW8xhuIJgR451MrMqyNA0qb3V0MqEpu1Ifoenuc7itHGjGrA3Bq0VLzuen3t6YsBDw==';
        $Signer = new RsaSigner($this->privateKey);
        $signature = $Signer->getSignature(['data' => ['test' => 1]]);
        $this->assertEquals($fixture, $signature);
    }

    private function getPrivateKey()
    {
        return openssl_get_privatekey(
            "-----BEGIN ENCRYPTED PRIVATE KEY-----
MIIFHDBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQIzzRTosJxOcACAggA
MAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECNZf7ll0MSbvBIIEyP0oM89tBDS2
1WeNGpYpUsq3JsRVzR+KyBVNJFltp59SYcmsa0r0RKGbtDE2GUUie2ouhpNOS0Tn
N2v/nUdcOAabJuP2QZH1FM6+wItjw80Fax45VZHsUCEDAI2k0LFnFEhOegjXNwbO
hYjYrRIHXa4Wc8WRcIOsaD8KQtSqfS40/I6SjogbcxoIpE+f725gJjfnsGxb5nQT
W8+i7anIL+fZXldNigdjQh6rKL/+DsnYqA1A0SPF0vb1WCPBXTpx0fveq7azX4xZ
rS9k0KA3dzmCrQgTM9xodBQ0AfB39jOoteiCIFHlucQBz7puOrRyqJ/Ow2doXNa8
4A/YK55gboxbjwxAAISdV6Ai894V76101HxIaI5adbDXuEGu3H6uQ2TI561UNtBf
+FCLQ5+IJuSsOPKHsmS52ugb5cYd5bEP7N9XhMkKkyS7AvArwA+iF3wMTtLQhAGB
0UaJV3yWV66OqPWcGZ9Pgy5xt6QAAxFlqaba5TjZsNeWvWD1Z1L4eqpxIkI/Zb5/
kXDtkQN+12LaJQQliljkK/XE7IouebdaX+RGZKTr2IXCDslnPi/0Z1savu63fm6D
aU5fjtAMfC845tJVpIzLWIR4kORcNqzBkAqB+upE6TygMSQLX6tczMNRy8pdHoLq
vgN0Powf2P6c+ytPsQphOSbglNOOZIR1nqPVOatlLrWO0P/WfxLuZxExvoLyDmgo
EctusL8492JzqoLwgOwolnDm01wWgHOCJrdNkwh7Ec5cZ62O8TQ/vnmSyyXlNwAz
YDaZpUQz7q+eSyex02UIQgAdFhd4yUxQsN8eZ6iVohfzfAtlWbmu4UJJz2nmhZDL
cR+1+ks4ckI8AKhwXQy8L5440/xZT0LeMyefuX152hAerX0I6h1ReLpUnstICXA7
ZNAzzQ2J8Ehja4HYK+H6hyXscmk5Eav51ko0oYfeq24vlS0KND+9E26IPGsEWRKX
jObWZToQT6RenFLr4JFwbB4f1WmageSzf2kSgakwtrqpt2e5ggEEuUyan4/a9EX/
P+Jrz/Tugt3OhX91goX6045+qOZDJaAtjUwRthv7R0SkmjVcDP73yLr3DdC7zRLB
lufg/4gzGaMUf7KwkeJecyVDC/9YlBk5kh5jGtxDTPnXsv5KUu40De5k+lQWJ+Uj
O5O89tZNwQp+Mzmwkbj691yoDJf5iF4uJFBQNwDRySG2QlJ0jmQtrGzJsWRJoxWQ
TdYsZwOdfJhCYsycVM389+eYo7Q7vrzzbgqhRSUfqYEAAa+LawF+wRmItZWyup7M
T47T9Cs4TYjERvV+vhebbXlZTRLXO+5DFd7u1XIyFpMHUaVolrX33TCMZCzx1+Yl
vuQEfEv1fTPrxHI8WiuG5ZYZoJKh/AXeFpevZiPw4aMPnAtR9AQyFgv8KlnVGplG
KDafKuzJdX+e0qFKsJIzaUVuHpqM38CPblPrwgzOlzJcXfkLb2lqBy1CaOvLP7Dm
YeFbEXEATLLPlbluLHZtBtXX5kAQO0mKZyNhoNtzyKmyVqHsq28z4hEMROjrb51C
OnE3PqWxBcZHMepM4wXMbucsTQTf6vgDpefmhWvSUJTQhXeowOY2zkswREixwBtQ
+/xWL3a5ZfEBecnoqYv7TQ==
-----END ENCRYPTED PRIVATE KEY-----",
            123
        );
    }

    private function getPublicKey()
    {
        return openssl_get_publickey("-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAx5B70y7kaFJ8yte7dsdt
vuPYNfN2j1hJSChPuOM4oWY8uUmmGl6f33CJQ69IClWle9I3HIUm81yT3QCVnD7l
r/JYse6cI2vILIaIdvmqu6VcDaiv+O+sUbPoRxq9lxfY5GnHFSrzUBy1yDugCuAE
TM2iRnHpYHbbILDrVs9csfLEeaJ56zn5kan9qJM4ecPKPXv6OabGHK9JkROxQyya
YJPk0mrA98jGvh9/ZrZxQuvH/Kvh61SXC3cpidKkIsCyw2vr0x6A5RnGU8q9fLdW
Ua4nSr1picTSmbryCb/zVGtH4ZgNXFYl7peQu7qNOeohyQFgwAtaYeg/NEDz90nu
sQIDAQAB
-----END PUBLIC KEY-----");
    }
}
