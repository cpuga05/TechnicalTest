<?php

declare(strict_types = 1);

namespace Shop\Infrastructure\UI\Console;

use Exception;
use Ramsey\Uuid\Uuid;
use ReflectionClass;
use Shop\Application\Service\Cart\ChangeCurrency\ChangeCurrencyCartQuery;
use Shop\Application\Service\Cart\RemoveProduct\RemoveProductCartCommand;
use Shop\Application\Service\Cart\Take\TakeCartCommand;
use Shop\Application\Service\Cart\TakeProduct\TakeProductCartCommand;
use Shop\Application\Service\Cart\View\ViewCartQuery;
use Shop\Application\Service\Product\Create\CreateProductCommand;
use Shop\Application\Service\Product\Find\All\FindAllProductsQuery;
use Shop\Application\Service\Product\Find\One\FindOneProductQuery;

require __DIR__.'/../../../../../vendor/autoload.php';

$core = new Core();

$core->dispatch(new CreateProductCommand(uuid::uuid4(), '1', 'Lagavulin 16 Years', '50EUR', 5, '48EUR'));
$core->dispatch(new CreateProductCommand(Uuid::uuid4(), '2', 'Ardbeg 10 Years', '40EUR', 10, '37EUR'));
$core->dispatch(new CreateProductCommand(Uuid::uuid4(), '3', 'Laphroaig 10 Years', '30EUR', 10, '28EUR'));
$core->dispatch(new CreateProductCommand(Uuid::uuid4(), '4', 'Talisker Storm', '35EUR', 12, '30EUR'));
$core->dispatch(new CreateProductCommand(Uuid::uuid4(), '5', 'Talisker 10 Years', '30EUR', 10, '27EUR'));

$start  = true;
$cartId = Uuid::uuid4()->toString();

$core->dispatch(new TakeCartCommand(Uuid::uuid4(), $cartId));

printLine('Welcome to Uvinum Shop!');
printLine();

do {
    try {
        printBorder();
        showCart($core, $cartId);
        printMenu();
        printLine();

        do {
            $request = (int)waitToRequest('What do you want do? ');
        } while ($request < 0 || $request > 9);

        printLine();

        switch ($request) {
            case 0:
                $start = false;
                break;
            case 1:
                showProducts($core);
                printLine();
                waitToRequest('Press any key to continue...');
                break;
            case 2:
                takeProduct($core, $cartId);
                break;
            case 3:
                removeProduct($core, $cartId);
                break;
            case 4:
                changeCurrency($core, $cartId);
                printLine();
                waitToRequest('Press any key to continue...');
                break;
        }

        printLine();
    } catch (Exception $e) {
        printLine('['.(new ReflectionClass($e))->getShortName().'] '.$e->getMessage());
        printLine();
    };
} while ($start);

printLine('Thanks for the visit :)');

function changeCurrency(Core $core, string $cartId): void
{
    $cart     = $core->ask(new ViewCartQuery(Uuid::uuid4(), $cartId));
    $currency = waitToRequest('What currency do you want to see the amount? (Ex USD, CZK...) ');

    $totalPriceWithoutOffers = $core->ask(new ChangeCurrencyCartQuery(
            Uuid::uuid4(),
            $cart->totalPriceWithoutOffers(),
            $currency
        )
    );
    $totalPriceWithOffers    = $core->ask(new ChangeCurrencyCartQuery(
            Uuid::uuid4(),
            $cart->totalPriceWithOffers(),
            $currency
        )
    );

    printLine(sprintf('%25s: %-10s => %-10s',
            'TotalPriceWithoutOffer',
            $cart->totalPriceWithoutOffers(),
            $totalPriceWithoutOffers->money()
        )
    );
    printLine(sprintf('%25s: %-10s => %-10s',
            'TotalPriceWithOffer',
            $cart->totalPriceWithOffers(),
            $totalPriceWithOffers->money()
        )
    );
}

function takeProduct(Core $core, string $cartId): void
{
    showProducts($core);
    printLine();

    $productId = waitToRequest('What product do you want to take? [Product Id] ');
    $units     = (int)waitToRequest('How many units? ');

    $core->dispatch(new TakeProductCartCommand(Uuid::uuid4(), $cartId, $productId, $units));
}

function removeProduct(Core $core, string $cartId): void
{
    showCart($core, $cartId);

    $productId = waitToRequest('What product do you want to remove? [Product Id] ');

    $core->dispatch(new RemoveProductCartCommand(Uuid::uuid4(), $cartId, $productId));
}

function showCart(Core $core, string $cartId): void
{
    $cart = $core->ask(new ViewCartQuery(Uuid::uuid4(), $cartId));

    printLine('Your cart:');
    printLine(sprintf('%-10s %-20s %-10s %-15s %-10s %-15s', 'ProductId', 'Name', 'Units', 'TotalPrice', 'Offer',
        'TotalOfferPrice'));

    foreach ($cart->lines() as $line) {
        $product = $core->ask(new FindOneProductQuery(Uuid::uuid4(), $line->productId()));

        printLine(sprintf('%-10s %-20s %-10s %-15s %-10s %-15s',
            $line->productId(),
            $product->name(),
            $line->units(),
            $line->totalPrice(),
            $line->offer() ? 'true' : 'false',
            $line->totalOfferPrice()
        ));
    }

    printLine(sprintf('%25s: %-25s', 'TotalPriceWithoutOffer', $cart->totalPriceWithoutOffers()));
    printLine(sprintf('%25s: %-25s', 'TotalPriceWithOffer', $cart->totalPriceWithOffers()));

    printLine();
}

function showProducts(Core $core): void
{
    $products = $core->ask(new FindAllProductsQuery(Uuid::uuid4()));

    printLine(sprintf('%-10s %-20s %-10s %-15s %-15s', 'ProductId', 'Name', 'Price', 'OfferUnits', 'OfferPrice'));

    foreach ($products as $product) {
        printLine(sprintf('%-10s %-20s %-10s %-15s %-15s',
            $product->id(),
            $product->name(),
            $product->price(),
            $product->offerUnits(),
            $product->offerPrice()
        ));
    }
}

function waitToRequest(string $text = ''): string
{
    echo $text;

    $handle  = fopen('php://stdin', 'r');
    $request = trim(fgets($handle));

    return $request;
}

function printMenu(): void
{
    printLine('You can:');
    printLine('          [1] Show all products');
    printLine('          [2] Take product');
    printLine('          [3] Remove product');
    printLine('          [4] Change Currency');
    printLine('[Another key] Leave the store :(');
}

function printBorder(): void
{
    printLine('==================== Uvinum Shop ====================');
}

function printLine(string $text = ''): void
{
    echo $text.PHP_EOL;
}