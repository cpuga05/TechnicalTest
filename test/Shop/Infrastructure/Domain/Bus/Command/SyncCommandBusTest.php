<?php

declare(strict_types = 1);

namespace Test\Shop\Infrastructure\Domain\Bus\Command;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Command\Command;
use Shop\Infrastructure\Domain\Bus\Command\SyncCommandBus;

final class SyncCommandBusTest extends TestCase
{
    public function testBindAndDispatch()
    {
        $commandBus = new SyncCommandBus();

        $commandBus->bind(MockCommand::class, new MockCommandHandler());

        $this->assertNull($commandBus->dispatch(new MockCommand(Uuid::uuid4())));
    }

    public function testDispatchNotBindCommand()
    {
        $this->expectException(BadMethodCallException::class);

        $commandBus = new SyncCommandBus();

        $commandBus->dispatch(new MockCommand(Uuid::uuid4()));
    }
}

final class MockCommand extends Command
{
}

final class MockCommandHandler
{
    public function handle(MockCommand $command): void
    {
    }
}