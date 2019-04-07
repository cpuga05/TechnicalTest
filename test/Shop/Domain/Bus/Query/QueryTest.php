<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Bus\Query;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Query\Query;

final class QueryTest extends TestCase
{
    public function testConstruct()
    {
        $uuid    = Uuid::uuid4();
        $command = new AQuery($uuid);

        $this->assertEquals($uuid, $command->queryId());
    }
}

class AQuery extends Query
{

}