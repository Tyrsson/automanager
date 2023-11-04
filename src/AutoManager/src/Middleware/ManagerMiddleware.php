<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\ManufacturerInterface;
use AutoManager\ModelInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ManagerMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Do some work then pass off to the ManagerHandler
        return $handler->handle($request);
    }
}
