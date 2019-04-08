<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Cart\View;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Cart\View\ViewCartService;
use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;
use Shop\Domain\Model\Cart\CartRepository;

final class ViewCartServiceTest extends TestCase implements CartRepository
{
    public function testNotExistsCart()
    {
        $this->expectException(CartNotExists::class);

        $service = new ViewCartService($this);

        $service->execute(new CartId('no'));
    }

    public function testExistsProduct()
    {
        $service = new ViewCartService($this);

        $service->execute(new CartId('yes'));

        $this->expectNotToPerformAssertions();
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