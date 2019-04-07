<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Bus\Command;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Command\Command;

final class CommandTest extends TestCase
{
    public function testConstruct()
    {
        $uuid    = Uuid::uuid4();
        $command = new ACommand($uuid);

        $this->assertEquals($uuid, $command->commandId());
    }
}

class ACommand extends Command
{

}