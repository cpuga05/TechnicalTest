<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\Take;

use Shop\Domain\Model\Cart\CartId;

final class TakeCartCommandHandler
{
    /**
     * @var TakeCartService
     */
    private $takeCartService;

    public function __construct(TakeCartService $takeCartService)
    {
        $this->takeCartService = $takeCartService;
    }

    /**
     * @param TakeCartCommand $command
     */
    public function handle(TakeCartCommand $command): void
    {
        $id = new CartId($command->id());

        $this->takeCartService->execute($id);
    }
}