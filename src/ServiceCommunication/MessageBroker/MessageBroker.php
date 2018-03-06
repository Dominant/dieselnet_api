<?php

namespace Dieselnet\ServiceCommunication\MessageBroker;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class MessageBroker
{
    /**
     * @var AMQPChannel[]
     */
    private $channelMap = [];

    /**
     * @var AMQPStreamConnection
     */
    private $connection;

    /**
     * @param AMQPStreamConnection $connection
     */
    public function __construct(AMQPStreamConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param MessageInterface $message
     */
    public function produce(MessageInterface $message): void
    {
        $channel = $this->channelFor($message);
        $amqpMessage = new AMQPMessage($message->toJson(), [
            'content_type' => 'application/json'
        ]);
        $channel->basic_publish($amqpMessage, '', $message->queueName());
    }

    /**
     * @param MessageInterface $message
     * @return AMQPChannel
     */
    private function channelFor(MessageInterface $message): AMQPChannel
    {
        $messageQueueName = $message->queueName();

        if (isset($this->channelMap[$messageQueueName])) {
            return $this->channelMap[$messageQueueName];
        }

        $channel = $this->connection->channel();
        $channel->queue_declare($messageQueueName, false, true, false, false);
        $this->channelMap[$messageQueueName] = $channel;

        return $channel;
    }
}
