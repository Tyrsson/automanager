<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\ModelInterface;
use AutoManager\Storage\Repository\ModelRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ModelMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ModelRepository $repo
    ) {
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // $response = $handler->handle($request);
        $entity = null;
        $model  = $request->getAttribute('model');
        if ($model !== null) {
            try {
                $entity = $this->repo->findOneByColumn('modelName', $model);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        $request = $request->withAttribute(ModelInterface::class, $entity);
        return $handler->handle($request);
    }
}
