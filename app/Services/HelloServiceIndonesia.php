<?php

namespace App\Services;

class HelloServiceIndonesia implements HelloService
{

    public function hello(string $name): string
    {
        return "Halo $name";
    }
}
