<?php

declare(strict_types=1);

use App\ADR\Action\REST\IntroduceYourselfRESTActionHandler;
use App\ADR\Action\REST\ListGreetingsRESTActionHandler;
use App\ADR\Action\Web\IntroduceYourselfWebActionHandler;
use App\Middleware\LanguageToLowerCaseMiddleware;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get(
        '/[{single-page:single-page}]',
        [
            LanguageToLowerCaseMiddleware::class,
            IntroduceYourselfWebActionHandler::class,
        ],
        'home'
    );
    $app->route('/api/you/introduce', IntroduceYourselfRESTActionHandler::class);
    $app->route('/api/greetings', ListGreetingsRESTActionHandler::class);
};
