<?php

declare(strict_types=1);

namespace App;

use App\ADR\Action\REST\IntroduceYourselfRESTActionHandler;
use App\ADR\Action\REST\ListGreetingsRESTActionHandler;
use App\ADR\Action\Web\IntroduceYourselfWebActionHandler;
use App\ADR\Domain\GetGreetingOptions\GetGreetingOptionsDomain;
use App\ADR\Domain\GreetUser\GreetUserDomain;
use App\ADR\Responder\REST\IntroduceYourselfRESTResponder;
use App\ADR\Responder\REST\ListGreetingsRESTResponder;
use App\ADR\Responder\Web\IntroduceYourselfWebResponder;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                GreetUserDomain::class => GreetUserDomain::class,
                GetGreetingOptionsDomain::class => GetGreetingOptionsDomain::class,
            ],
            'factories'  => [
                IntroduceYourselfWebActionHandler::class  => ReflectionBasedAbstractFactory::class,
                IntroduceYourselfWebResponder::class      => ReflectionBasedAbstractFactory::class,
                IntroduceYourselfRESTActionHandler::class => ReflectionBasedAbstractFactory::class,
                IntroduceYourselfRESTResponder::class     => ReflectionBasedAbstractFactory::class,

                ListGreetingsRESTActionHandler::class     => ReflectionBasedAbstractFactory::class,
                ListGreetingsRESTResponder::class         => ReflectionBasedAbstractFactory::class,
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
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
