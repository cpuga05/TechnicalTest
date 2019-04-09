<?php

declare(strict_types = 1);

namespace Shop\Infrastructure\Domain\Bus\Command;

use BadMethodCallException;
use Shop\Domain\Bus\Command\Command;
use Shop\Domain\Bus\Command\CommandBus;

final class SyncCommandBus implements CommandBus
{
    /**
     * @var array
     */
    private $handlers;

    public function __construct()
    {
        $this->handlers = [];
    }

    /**
     * @param string $commandName
     * @param        $commandHandler
     */
    public function bind(string $commandName, $commandHandler): void
    {
        $this->handlers[$commandName] = $commandHandler;
    }

    /**
     * @param Command $command
     */
    public function dispatch(Command $command): void
    {
        $commandName = get_class($command);

        if (! isset($this->handlers[$commandName])) {
            throw new BadMethodCallException('Command not registered');
        }

        $this->handlers[$commandName]->handle($command);
    }
}