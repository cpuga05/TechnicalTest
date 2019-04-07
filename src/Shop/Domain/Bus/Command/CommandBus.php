<?php

declare(strict_types = 1);

namespace Shop\Domain\Bus\Command;

interface CommandBus
{
    /**
     * @param string $commandName
     * @param        $commandHandler
     */
    public function bind(string $commandName, $commandHandler): void;

    /**
     * @param Command $command
     */
    public function dispatch(Command $command): void;
}