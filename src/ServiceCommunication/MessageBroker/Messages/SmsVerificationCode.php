<?php

namespace Dieselnet\ServiceCommunication\MessageBroker\Messages;

use Dieselnet\ServiceCommunication\MessageBroker\MessageInterface;

class SmsVerificationCode implements MessageInterface
{
    const QUEUE_NAME = 'sms_verification_code';

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $code;

    /**
     * @param string $phone
     * @param string $code
     */
    public function __construct(string $phone, string $code)
    {
        $this->phone = $phone;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function queueName(): string
    {
        return self::QUEUE_NAME;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode([
            'phone' => $this->phone,
            'code' => $this->code
        ]);
    }
}
