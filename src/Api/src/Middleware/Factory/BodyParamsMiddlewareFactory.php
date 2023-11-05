<?php

declare(strict_types=1);

namespace Api\Middleware\Factory;

use Mezzio\Helper\BodyParams\BodyParamsMiddleware;
use Mezzio\Helper\BodyParams\FormUrlEncodedStrategy;
use Psr\Container\ContainerInterface;

final class BodyParamsMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): BodyParamsMiddleware
    {
        $middleware = new BodyParamsMiddleware();
        $middleware->addStrategy(new FormUrlEncodedStrategy());
        return $middleware;
    }
}
