<?php
include('PangyaCalculateMiddleware/PinGenerator.php');

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use PangyaCalculateMiddleware\PinGenerator;

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
                $this->get('/' . $shotType['shotType'] . '/{club}',
                    pinRouterBuilder($shotType['prefix'], $shotType['shotType']));
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

function pinRouterBuilder ($prefix, $shotType) {
    return function (Request $request, Response $response, array $args) use ($prefix, $shotType) {
        if( !isset($args['club']) ) {
            return json_encode([]);
        }

        $generator = new PinGenerator();

        $club = $args['club'];

        try {
            $response = $generator->
                getGeneratorSimpleValue($prefix . strtoupper($club) . '.xls', $shotType);
        } catch (Exception $exception) {
            return json_encode([]);
        }

        return json_encode($response);
    };
}