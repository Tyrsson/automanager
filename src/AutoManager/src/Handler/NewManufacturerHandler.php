<?php

declare(strict_types=1);

namespace AutoManager\Handler;

use AutoManager\Form\Manufacturer;
use AutoManager\Storage\Repository\ManufacturerRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Form\FormElementManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Mezzio\Template\TemplateRendererInterface;

class NewManufacturerHandler implements RequestHandlerInterface
{
    public function __construct(
        private Manufacturer $form,
        private ManufacturerRepository $repo,
        private TemplateRendererInterface $renderer
    ) {
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if ('POST' === $request->getMethod()) {
            $this->form->setData($request->getParsedBody());
            $this->form->setValidationGroup(['manufacturer']);
            if ($this->form->isValid()) {
                try {
                    $entity = $this->form->getData();
                    $queryResult = $this->repo->save($entity);
                    if ($queryResult) {
                        // this is working, send notification
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'auto-manager::new-manufacturer',
            ['form' => $this->form] // parameters to pass to template
        ));
    }
}
