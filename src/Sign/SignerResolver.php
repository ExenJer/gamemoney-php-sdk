<?php
namespace Gamemoney\Sign;

use Gamemoney\Request\RequestInterface;
use Gamemoney\Sign\Signer\RsaSigner;
use Gamemoney\Sign\Signer\HmacSigner;

/**
 * Class SignerResolver
 * @package Gamemoney\Sign
 */
class SignerResolver implements SignerResolverInterface
{
    private $hmacKey;
    private $privateKey;
    private $passphrase;

    /**
     * SignerResolver constructor.
     * @param string $hmacKey
     * @param resource|string $privateKey
     * @param string $passphrase
     */
    public function __construct($hmacKey, $privateKey, $passphrase)
    {
        $this->hmacKey = $hmacKey;
        $this->privateKey = $privateKey;
        $this->passphrase = $passphrase;
    }

    /**
     * @inheritdoc
     */
    public function resolve($action)
    {
        if ($action === RequestInterface::CHECKOUT_CREATE_ACTION) {
            return new RsaSigner($this->privateKey, $this->passphrase);
        }

        return new HmacSigner($this->hmacKey);
    }
}