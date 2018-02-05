<?php

namespace Dieselnet\Application\Commands;

class CommandMapper
{
    public function getCommandHandler(string $command)
    {
        $pattern = '/Command$/';
        $replacement = 'Handler';

        if (!preg_match($pattern, $command)) {
            throw new NotMappedException();
        }

        return preg_replace($pattern, $replacement, $command);
    }
}
