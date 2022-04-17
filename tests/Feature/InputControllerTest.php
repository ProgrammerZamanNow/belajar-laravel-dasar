<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Eko')
            ->assertSeeText('Hello Eko');

        $this->post('/input/hello', [
            'name' => 'Eko'
        ])->assertSeeText('Hello Eko');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Eko",
                "last" => "Khannedy"
            ]
        ])->assertSeeText("Hello Eko");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Eko",
                "last" => "Khannedy"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Eko")
            ->assertSeeText("Khannedy");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birth_date' => '1990-10-10'
        ])->assertSeeText('Budi')->assertSeeText("true")->assertSeeText("1990-10-10");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Eko",
                "middle" => "Kurniawan",
                "last" => "Khannedy"
            ]
        ])->assertSeeText("Eko")->assertSeeText("Khannedy")
            ->assertDontSeeText("Kurniawan");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "khannedy",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("khannedy")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }


    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "khannedy",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("khannedy")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }


}
