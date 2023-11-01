<?php

declare(strict_types=1);

namespace AutoManager\Middleware;

use AutoManager\Storage\Repository\ManufacturerRepository;
use Fig\Http\Message\StatusCodeInterface as RequestStatus;
use Laminas\Diactoros\Response\EmptyResponse;
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
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $action = $request->getAttribute('action');
        return match($action) {
            'add'   => $this->addAction($request),
            'index' => $this->indexAction($request),
            default => $this->indexAction($request),
        };
    }

    private function addAction(ServerRequestInterface $request)
    {
        $attribs = $request->getAttributes();
        //$post    = $request->
        return match($attribs['type']) {
            'manufacturer', 'model', 'vehicle' => new HtmlResponse(
                $this->template->render('auto-manager::add-' . $attribs['type'] .'.phtml')
            ),
            default => new EmptyResponse(RequestStatus::STATUS_NOT_FOUND),
        };
    }

    private function indexAction(ServerRequestInterface $request): ResponseInterface
    {
        $attribs = $request->getAttributes();
        return match($attribs['type']) {

        };
        return new HtmlResponse($this->template->render('auto-manager::index'));
    }
}
