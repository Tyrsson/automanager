<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\ManufacturerInterface;
use AutoManager\ModelInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ManagerMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TemplateRendererInterface $template
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (
            null !== $request->getAttribute(ManufacturerInterface::class)
            && null !== $request->getAttribute(ModelInterface::class)
        ){
            return new HtmlResponse($this->template->render('auto-manager::manager'));
        }
        // This allows the application to return a templated 404 Not Found
        return $handler->handle($request);
    }
}
