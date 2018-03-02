<?php

use DI\ContainerBuilder;
use Dieselnet\Application\EventDispatcherInterface;
use Dieselnet\ServiceCommunication\EventHandlers\UserEvents;
use Dieselnet\Domain\User\Events\UserSignupEvent;
use Dieselnet\Domain\Authorization\Token\Verifier as TokenVerifier;
use Dieselnet\Infrastructure\Authorization;
use Dieselnet\Infrastructure\Http\Middlewares\JsonRequestMiddleware;
use Dieselnet\Infrastructure\Http\Middlewares\JsonResponseMiddleware;
use Dieselnet\Infrastructure\Http\Middlewares\TokenVerifierMiddleware;
use Dieselnet\Infrastructure\Http\Actions as WebActions;
use Dieselnet\Infrastructure\Environment;

$app = new class() extends \DI\Bridge\Slim\App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        if (!Environment\Detector::fromEnvironmentVars()->isDevelopment()) {
            $builder->enableDefinitionCache();
            $builder->enableCompilation(PROJECT_ROOT . '/tmp');
            $builder->writeProxiesToFile(true, PROJECT_ROOT . '/tmp');
        }

        $builder->addDefinitions([
            'settings.httpVersion' => '1.1',
            'settings.responseChunkSize' => 4096,
            'settings.outputBuffering' => 'append',
            'settings.determineRouteBeforeAppMiddleware' => true,
            'settings.displayErrorDetails' => true,
            'settings.debug' => true
        ]);

        $builder->addDefinitions(PROJECT_ROOT . '/src/definitions.php');
    }
};

$container = $app->getContainer();
$app->add(new TokenVerifierMiddleware($container->get(TokenVerifier::class)));
$app->add(new JsonRequestMiddleware());
$app->add(new JsonResponseMiddleware());

$container->get(EventDispatcherInterface::class)->addListener(UserSignupEvent::NAME, [UserEvents::class, 'onUserSignup']);

$app->get('/', WebActions\Home\Home::class)->setName('home');
$app->get('/signup', WebActions\User\Signup::class)->setName('signup');

return $app;
