<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\Take;

use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Command\Command;

final class TakeCartCommand extends Command
{
    /**
     * @var string
     */
    private $id;

    public function __construct(Uuid $commandId, string $id)
    {
        parent::__construct($commandId);
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}