<?php

declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Infrastructure\DependencyInjection\ServiceProvider;

/**
 * Classe principale de l'application
 *
 * Configure le bootstrap et les couches de middleware
 * utilisées par l'application.
 */
class Application extends BaseApplication
{
    /**
     * Charger la configuration et initialiser l'application
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Appeler le parent pour charger les fichiers de bootstrap
        parent::bootstrap();

        // Charger le plugin Migrations
        $this->addPlugin('Migrations');

        // Charger le plugin LogViewer
        $this->addPlugin('LogViewer');

        if (PHP_SAPI !== 'cli') {
            FactoryLocator::add(
                'Table',
                (new TableLocator())->allowFallbackClass(false)
            );
        }

        // Charger DebugKit uniquement en développement
        // DebugKit ne doit pas être installé sur un serveur de production
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }
    }

    /**
     * Ajouter les couches de middleware à l'application
     *
     * @param MiddlewareQueue $middlewareQueue Le gestionnaire de middleware
     * @return MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Traiter les erreurs
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))
            // Servir les fichiers statiques (CSS, JS, images, etc.)
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            // Router les requêtes
            ->add(new RoutingMiddleware($this))
            // Parser le corps des requêtes POST/PUT
            ->add(new BodyParserMiddleware())
            // Protection CSRF
            ->add(new CsrfProtectionMiddleware([
                'httpOnly' => true,
                'secure' => false,
            ]));

        return $middlewareQueue;
    }

    /**
     * Configurer les services du conteneur DI
     *
     * @param ContainerInterface $container
     * @return void
     */
    public function services(ContainerInterface $container): void
    {
        // Créer et enregistrer le fournisseur de services personnalisé
        $serviceProvider = new ServiceProvider($container);
        $serviceProvider->register($container);
    }
}
