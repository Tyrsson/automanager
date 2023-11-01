<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\Storage\Repository\ManufacturerRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ActionMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
        private ManufacturerRepository $manufacturer
    ) {

    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $action = $request->getAttribute('action', 'index');
        return match($action) {
            'index' => $this->indexAction($request),
            default => $this->indexAction($request),
        };
    }

    private function indexAction(ServerRequestInterface $request)
    {
        return new HtmlResponse($this->template->render('auto-manager::index'));
    }
}
