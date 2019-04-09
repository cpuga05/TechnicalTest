<?php

declare(strict_types = 1);

namespace Test\Shop\Infrastructure\Domain\Bus\Command;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Query\Query;
use Shop\Domain\Bus\Query\Response;
use Shop\Infrastructure\Domain\Bus\Query\SyncQueryBus;

final class SyncQueryBusTest extends TestCase
{
    public function testBindAndAsk()
    {
        $queryBus = new SyncQueryBus();

        $queryBus->bind(MockQuery::class, new MockQueryHandler());

        $this->assertInstanceOf(MockResponse::class, $queryBus->ask(new MockQuery(Uuid::uuid4())));
    }

    public function testAskNotBindQuery()
    {
        $this->expectException(BadMethodCallException::class);

        $queryBus = new SyncQueryBus();

        $queryBus->ask(new MockQuery(Uuid::uuid4()));
    }
}

final class MockQuery extends Query
{
}

final class MockQueryHandler
{
    public function handle(MockQuery $query): Response
    {
        return new MockResponse();
    }
}

final class MockResponse implements Response
{
}