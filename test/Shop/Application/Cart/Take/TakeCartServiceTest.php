<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Cart\Take;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Cart\Take\TakeCartService;
use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartAlreadyExists;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartRepository;

final class TakeCartServiceTest extends TestCase implements CartRepository
{
    public function testNotExistsCart()
    {
        $service = new TakeCartService($this);

        $service->execute(new CartId('no'));

        $this->expectNotToPerformAssertions();
    }

    public function testExistsCart()
    {
        $this->expectException(CartAlreadyExists::class);

        $service = new TakeCartService($this);

        $service->execute(new CartId('yes'));
    }

    public function save(Cart $cart): void
    {

    }

    public function ofId(CartId $id): ?Cart
    {
        if ($id->id() === 'no') {
            return null;
        } else {
            return new Cart(CartId::random());
        }
    }
}