<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\ManufacturerInterface;
use AutoManager\Storage\Repository\ManufacturerRepository;
use Fig\Http\Message\StatusCodeInterface as RequestStatus;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ManufacturerMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ManufacturerRepository $repo
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $entity = null;
        $manufacturer = $request->getAttribute('manufacturer');
        if ($manufacturer !== null) {
            try {
                $entity = $this->repo->findOneByColumn('manufacturerName', $manufacturer);
            } catch (\Throwable $th) {
                throw $th;
            }

        }
        $request = $request->withAttribute(ManufacturerInterface::class, $entity);
        return $handler->handle($request);
    }
}
