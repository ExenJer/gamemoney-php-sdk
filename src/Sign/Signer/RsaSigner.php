<?php
namespace Gamemoney\Sign\Signer;

use Gamemoney\Exception\ConfigException;
use Gamemoney\Sign\ArrayToStringTrait;
use Gamemoney\Sign\SignerInterface;

final class RsaSigner implements SignerInterface
{
    use ArrayToStringTrait;

    private $privateKey;
    private $passphrase;

    public function __construct($privateKey, $passphrase = '')
    {
        if (empty($privateKey)) {
            throw new ConfigException('privateKey is not set in config');
        }

        $this->privateKey = $privateKey;
        $this->passphrase = $passphrase;
    }

    /**
     * @inheritdoc
     */
    public function getSignature(array $data)
    {
        openssl_sign(
            $this->arrayToString($data),
            $signature,
            openssl_get_privatekey($this->privateKey, $this->passphrase),
            "sha256"
        );

        return base64_encode($signature);
    }
}