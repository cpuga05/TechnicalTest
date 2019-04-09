<?php

declare(strict_types = 1);

namespace Shop\Infrastructure\UI\Console;

use Shop\Application\Service\Cart\ChangeCurrency\ChangeCurrencyCartQuery;
use Shop\Application\Service\Cart\ChangeCurrency\ChangeCurrencyCartQueryHandler;
use Shop\Application\Service\Cart\ChangeCurrency\ChangeCurrencyCartService;
use Shop\Application\Service\Cart\RemoveProduct\RemoveProductCartCommand;
use Shop\Application\Service\Cart\RemoveProduct\RemoveProductCartCommandHandler;
use Shop\Application\Service\Cart\RemoveProduct\RemoveProductCartService;
use Shop\Application\Service\Cart\Take\TakeCartCommand;
use Shop\Application\Service\Cart\Take\TakeCartCommandHandler;
use Shop\Application\Service\Cart\Take\TakeCartService;
use Shop\Application\Service\Cart\TakeProduct\TakeProductCartCommand;
use Shop\Application\Service\Cart\TakeProduct\TakeProductCartCommandHandler;
use Shop\Application\Service\Cart\TakeProduct\TakeProductCartService;
use Shop\Application\Service\Cart\View\ViewCartQuery;
use Shop\Application\Service\Cart\View\ViewCartQueryHandler;
use Shop\Application\Service\Cart\View\ViewCartService;
use Shop\Application\Service\Product\Create\CreateProductCommand;
use Shop\Application\Service\Product\Create\CreateProductCommandHandler;
use Shop\Application\Service\Product\Create\CreateProductService;
use Shop\Application\Service\Product\Find\All\FindAllProductsQuery;
use Shop\Application\Service\Product\Find\All\FindAllProductsQueryHandler;
use Shop\Application\Service\Product\Find\All\FindAllProductsService;
use Shop\Application\Service\Product\Find\One\FindOneProductQuery;
use Shop\Application\Service\Product\Find\One\FindOneProductQueryHandler;
use Shop\Application\Service\Product\Find\One\FindOneProductService;
use Shop\Domain\Bus\Command\Command;
use Shop\Domain\Bus\Command\CommandBus;
use Shop\Domain\Bus\Query\Query;
use Shop\Domain\Bus\Query\QueryBus;
use Shop\Domain\Bus\Query\Response;
use Shop\Domain\Model\Cart\CartRepository;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Infrastructure\Domain\Bus\Command\SyncCommandBus;
use Shop\Infrastructure\Domain\Bus\Query\SyncQueryBus;
use Shop\Infrastructure\Domain\Model\Cart\InMemoryCartRepository;
use Shop\Infrastructure\Domain\Model\Product\InMemoryProductRepository;
use Shop\Infrastructure\Domain\Model\Shared\RestMoneyConverter;

final class Core
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @var RestMoneyConverter
     */
    private $moneyConverter;

    public function __construct()
    {
        $this->productRepository = new InMemoryProductRepository();
        $this->cartRepository    = new InMemoryCartRepository();
        $this->commandBus        = new SyncCommandBus();
        $this->queryBus          = new SyncQueryBus();
        $this->moneyConverter    = new RestMoneyConverter();

        $this->bindCommands();
        $this->bindQueries();
    }

    private function bindCommands(): void
    {
        $this->commandBus->bind(
            CreateProductCommand::class,
            new CreateProductCommandHandler(new CreateProductService($this->productRepository))
        );

        $this->commandBus->bind(
            TakeCartCommand::class,
            new TakeCartCommandHandler(new TakeCartService($this->cartRepository))
        );

        $this->commandBus->bind(
            TakeProductCartCommand::class,
            new TakeProductCartCommandHandler(
                new TakeProductCartService(
                    $this->cartRepository,
                    $this->productRepository
                )
            )
        );

        $this->commandBus->bind(
            RemoveProductCartCommand::class,
            new RemoveProductCartCommandHandler(
                new RemoveProductCartService(
                    $this->cartRepository,
                    $this->queryBus
                )
            )
        );
    }

    private function bindQueries(): void
    {
        $this->queryBus->bind(
            FindOneProductQuery::class,
            new FindOneProductQueryHandler(new FindOneProductService($this->productRepository))
        );

        $this->queryBus->bind(
            FindAllProductsQuery::class,
            new FindAllProductsQueryHandler(new FindAllProductsService($this->productRepository))
        );

        $this->queryBus->bind(
            ViewCartQuery::class,
            new ViewCartQueryHandler(new ViewCartService($this->cartRepository))
        );

        $this->queryBus->bind(
            ChangeCurrencyCartQuery::class,
            new ChangeCurrencyCartQueryHandler(new ChangeCurrencyCartService($this->moneyConverter))
        );
    }

    /**
     * @param Command $command
     */
    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }

    /**
     * @param Query $query
     *
     * @return Response
     */
    public function ask(Query $query): Response
    {
        return $this->queryBus->ask($query);
    }
}