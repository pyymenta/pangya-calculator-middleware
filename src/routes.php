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
            $this->get('/backspin',
                function (Request $request, Response $response, array $args) use ($container) {
                    // Sample log message

                    $generator = new PinGenerator();
                    $response = $generator->getGeneratorSimpleValue('bs_1W.xls', 'backspin');

                    return json_encode($response);
                }
            );
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