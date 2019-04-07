<?php

declare(strict_types = 1);

namespace Shop\Domain\Bus\Command;

use Ramsey\Uuid\Uuid;

abstract class Command
{
    /**
     * @var Uuid
     */
    private $commandId;

    public function __construct(Uuid $commandId)
    {
        $this->commandId = $commandId;
    }

    /**
     * @return Uuid
     */
    public function commandId(): Uuid
    {
        return $this->commandId;
    }
}