<?php
namespace Gamemoney;

use Gamemoney\Request\RequestInterface;
use Gamemoney\Send\Sender;
use Gamemoney\Send\SenderInterface;
use Gamemoney\Exception\ConfigException;
use Gamemoney\Validation\Validator;
use Gamemoney\Validation\ValidatorInterface;
use Gamemoney\Validation\RulesResolver;
use Gamemoney\Validation\RulesResolverInterface;
use Gamemoney\Sign\SignerResolver;

class Gateway
{
    const API_URL = 'https://paygate.gamemoney.com';

    /** @var int */
    private $project;
    /** @var  ValidatorInterface */
    private $validator;
    /** @var  RulesResolverInterface */
    private $rulesResolver;
    /** @var  SenderInterface */
    private $sender;

    /**
     * Gateway constructor.
     * @param array $config
     * @throws ConfigException
     */
    public function __construct($config)
    {
        if(empty($config['apiUrl'])) {
            $config['apiUrl'] = self::API_URL;
        }

        if(empty($config['project'])) {
            throw new ConfigException('Project id is not set');
        }

        if(empty($config['hmacKey'])) {
            throw new ConfigException('hmacKeyis not set');
        }

        if(empty($config['privateKey'])) {
            throw new ConfigException('privateKey id is not set');
        }

        if(empty($config['passphrase'])) {
            $config['passphrase'] = '';
        }

        $signerResolver = new SignerResolver(
            $config['hmacKey'],
            $config['privateKey'],
            $config['passphrase']
        );

        if(empty($config['clientConfig'])) {
            $config['clientConfig'] = [];
        }

        $sender = new Sender($config['apiUrl'], $signerResolver, $config['clientConfig']);

        $this->project = $config['project'];
        $this
            ->setValidator(new Validator)
            ->setRulesResolver(new RulesResolver)
            ->setSender($sender);
    }

    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;
        return $this;
    }

    public function setRulesResolver(RulesResolverInterface $rulesResolver)
    {
        $this->rulesResolver = $rulesResolver;
        return $this;
    }

    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
        return $this;
    }

    public function send(RequestInterface $request)
    {
        $request->setField('project', $this->project);
        $rules = $this->rulesResolver->resolve($request->getAction())->getRules();
        $this->validator->validate($rules, $request->getData());
        return $this->sender->send($request);
    }
}