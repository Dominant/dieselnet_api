<?php

namespace Dieselnet\Application;

class CommandMapper
{
    /**
     * @var string
     */
    private $commandNamespace;

    /**
     * @var string
     */
    private $handlerNamespace;

    /**
     * @param string $commandNamespace
     * @param string $handlerNamespace
     */
    public function __construct(string $commandNamespace, string $handlerNamespace)
    {
        $this->commandNamespace = $commandNamespace;
        $this->handlerNamespace = $handlerNamespace;
    }

    /**
     * Map command handler by command class name.
     *
     * @param string $command
     *
     * @return string
     */
    public function getCommandHandler(string $command)
    {
        $pattern = '/Command$/';
        $replacement = 'Handler';

        if (!preg_match($pattern, $command)) {
            throw new NotMappedException();
        }

        $command = str_replace($this->commandNamespace, $this->handlerNamespace, $command);
        return preg_replace($pattern, $replacement, $command);
    }
}
