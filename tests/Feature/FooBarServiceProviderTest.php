<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1,$foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);

        self::assertSame($foo1, $bar1->foo);
        self::assertSame($foo2, $bar2->foo);
    }

    public function testPropertySingletons()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertSame($helloService1, $helloService2);

        self::assertEquals('Halo Eko', $helloService1->hello('Eko'));
    }

    public function testEmpty()
    {
        self::assertTrue(true);
    }

}
