<?php

declare(strict_types=1);

namespace Api;

use Mezzio\Helper\BodyParams\BodyParamsMiddleware;

/**
 * The configuration provider for the Api module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'routes'       => $this->getRoutes(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                BodyParamsMiddleware::class => Middleware\Factory\BodyParamsMiddlewareFactory::class,
            ],
        ];
    }

    public function getRoutes(): array
    {
        return [
            [
                'name' => 'api-manufacturer',
                'path' => '/api/manufacturer',
                'middleware' => [
                    BodyParamsMiddleware::class,
                    Middleware\ManufacturerMiddleware::class,
                    Handler\ManufacturerHandler::class
                ],
                'allowed_methods' => ['GET', 'POST'],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'api'    => [__DIR__ . '/../templates'],
            ],
        ];
    }
}
