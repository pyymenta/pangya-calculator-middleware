<?php
include_once('PangyaCalculateMiddleware/PinRouterBuilder.php');

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use PangyaCalculateMiddleware\PinRouterBuilder;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/pins',
        function () {
            $shotTypes = [
                ['prefix' => 'bs_', 'shotType' => 'backspin'],
                ['prefix' => 'cobra_', 'shotType' => 'cobra'],
                ['prefix' => 'dunk_', 'shotType' => 'dunk'],
                ['prefix' => 'tomahawk_', 'shotType' => 'tomahawk'],
                ['prefix' => 'spike_', 'shotType' => 'spike'],
            ];

            foreach($shotTypes as $shotType) {
                $this->get('/' . $shotType['shotType'] . '/{power1w}/{club}',
                    PinRouterBuilder::createRouter($shotType));
            }
        }
    );

    $app->get('/[{name}]',
    function (Request $request, Response $response, array $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/' route");
        // Render index view
        return $this->renderer->render($response, 'index.phtml', $args);
    });
};
